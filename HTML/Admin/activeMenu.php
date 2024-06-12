<?php
include_once "../../PHP/dbConnection.php";
$sql = new Sql;
$direct = new Url; ?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel=stylesheet href="<?php $direct->directoryGeneral("CSS/Admin", "activeMenu", "CSS"); ?>" />
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
    <title>Menu</title>

</head>

<body>
 <div class="container"> 
    <a href="<?php $direct->directory("HTML/Admin", "mainMenu"); ?>" title="geri">Geri Git</a> <br><br>
    <?php
    session_start();
    if ($_SESSION['ID']) {
    } else {
        $direct->redirect("", "index");
    }


    $stmt = $conn->prepare("
SELECT 
    menu.ID as menuID,
    menu.menuName as menuName,
    category.categoryName, 
    product.productName, 
    product.categoryID,
    category.ID as categoryid,
    product.ID as productid,
    options.optionName, 
    options.optionPrice,
    options.productID
    

FROM 
    menu
JOIN 
    category ON category.menuID = menu.ID
LEFT JOIN 
    product ON product.categoryID = category.ID
LEFT JOIN 
    options ON options.productID = product.ID
WHERE
    menu.status = 1
ORDER BY 
   category.priority ASC;
"); //We selected all binded values to menu menuID -> category names -> option names -> option prices all of them has 1:m connection
    $count = 0;
    $stmt->execute(); //executed our sql query
    $categoryCheck = ""; //  we defined control variables
    $productNameCheck = ""; // we are using these to check if are repeating ourselves while listing products
    foreach ($stmt as $data) {

        $category = $data['categoryName'];
        $productName = $data['productName'];
        $optionName = $data['optionName'];
        $optionPrice = floatval($data['optionPrice']);
        $categoryID = $data['categoryID'];
        $categoryid = $data['categoryid'];
        $productID = $data['productID'];
        $productid = $data['productid'];
        $GLOBALS["ID"] = $data['menuID'];
        $menuName = $data['menuName'];
        $menuID = $GLOBALS["ID"];
        if ($count == 0) {echo $menuName;$count++;}
        
        if ($category == $categoryCheck) { // Checking if previous product's category is same as this product
            if ($productName != $productNameCheck) {
                echo "<div class='productName'>" . $productName . "</div><br>";
            } // Checking if previous product's name is same as the previous one
            echo "<div class='optionContainer'><div class='optionName'>" . $optionName . "</div> <div class='optionPrice'>" . $optionPrice . "₺</div></div><br><br>";
        } else {
            echo "<div class='categoryName'>" . $category . "</div><br>";
        
            echo "<div class='productName'>" . $productName . "</div><br>";
            if ($productName != "") {
                echo "<div class='optionContainer'><div class='optionName'>" . $optionName . "</div> <div class='optionPrice'>" . $optionPrice . "₺</div></div><br><br>";
            }
        }
        $productNameCheck = $productName;
        $categoryCheck = $category;
        
    }
    ?>
     Aktif Menüyü Değiştir 
    <?php
    $query = $conn->query("SELECT ID, menuName FROM menu ORDER BY timeStamp DESC", PDO::FETCH_ASSOC);

    foreach ($query as $data) {
        $menuName = $data['menuName'];
        $ID = $data['ID'];

        ?>
        <form action="<?php $direct->directory("PHP/Admin", "activeMenu"); ?>" method="POST">
            <input type="hidden" name="menuID" value="<?= htmlspecialchars($ID, ENT_QUOTES, 'UTF-8') ?>" />
            <input type="submit" value="<?= htmlspecialchars($menuName, ENT_QUOTES, 'UTF-8') ?>" />

        </form>
        <?php
    }
    ?>
    Kategori Sıralamasını Değiştir<?php
    $sql->updateCategoriesOrder();
    $sql->rearrangeCategoriesOrder($menuID);