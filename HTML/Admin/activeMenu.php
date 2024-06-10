 
<?php
include_once "../../PHP/dbConnection.php";
$direct = new Url; 
?> 
<a href="<?php $direct->directory("HTML/Admin", "mainMenu"); ?>" title="geri">Geri Git</a> <br><br>
<?php
session_start();
if($_SESSION['ID']){}else{$direct->redirect("","index");} 


$stmt = $conn->prepare("
SELECT 
    menu.ID as menuID,
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
    menu.ID, category.ID, product.ID, options.ID;
"); //We selected all binded values to menu menuID -> category names -> option names -> option prices all of them has 1:m connection

$stmt->execute(); //executed our sql query
$categoryCheck = ""; //  we defined control variables
$productNameCheck = ""; // we are using these to check if are repeating ourselves while listing products
foreach ($stmt as $data) {

$category = $data['categoryName'];
$productName = $data['productName'];
$optionName = $data['optionName'];
$optionPrice = $data['optionPrice'];
$categoryID = $data['categoryID'];
$categoryid = $data['categoryid'];
$productID = $data['productID'];
$productid = $data['productid'];

if($category == $categoryCheck){ // Checking if previous products category is same as this product
    if($productName != $productNameCheck){ echo $productName. "<br><br>";
         } //Checking if previous products name is same as previous one
       echo $optionName . " ". $optionPrice."<br>";
}else{ 
    echo "<br>".$category. "<br>";
    
    echo $productName;
    if($productName ==""){}else{
     
    echo $optionName . " " . $optionPrice."<br>";
    }
}
   
$productNameCheck = $productName;
$categoryCheck = $category;
}

?>
<h1> Aktif Menüyü Değiştir </h1>
<?php
$query = $conn->query("SELECT ID, menuName FROM menu ORDER BY timeStamp DESC", PDO::FETCH_ASSOC);

foreach ($query as $data) {
    $menuName = $data['menuName'];
    $ID = $data['ID'];
    ?> 
    <form action="<?php $direct->directory("PHP/Admin","activeMenu"); ?>" method="POST">
    <input type="hidden" name="menuID" value="<?= htmlspecialchars($ID, ENT_QUOTES, 'UTF-8') ?>" />
    <input type="submit" value="<?= htmlspecialchars($menuName, ENT_QUOTES, 'UTF-8') ?>" />

</form>
    <?php
}
  