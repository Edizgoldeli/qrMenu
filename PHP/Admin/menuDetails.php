 
<?php
include_once __DIR__ . "/../dbConnection.php";
$direct = new Url; 
$sql = new Sql;
?> 
<a href="<?php $direct->directory("HTML/Admin", "currentMenus"); ?>" title="geri"><img src="<?php echo $direct->directoryGeneral("images", "goBackArrow", "png"); ?>" alt="Geri Git"></a> <br><br>

<?php
session_start();
if($_SESSION['ID']){}else{$direct->redirect("","index");}
if(isset($_POST["menuID"])){$menuID = $_POST["menuID"];}else{$menuID = $_SESSION["menuID"];}


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
    menu.ID = $menuID
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
    if($productName != $productNameCheck){ echo "<h2>".$productName. "</h2>";
        ?> <form action="<?php $direct->directory("PHP/Admin","menuEdit"); ?>" method="POST">
        <input type="hidden" name="operation" value="addOption" />
        
        <input type="hidden" name="productID" value="<?= htmlspecialchars($productid, ENT_QUOTES, 'UTF-8') ?>" />
        <input type="hidden" name="categoryID" value="<?= htmlspecialchars($categoryID, ENT_QUOTES, 'UTF-8') ?>" />
        <input type="hidden" name="menuID" value="<?= htmlspecialchars($menuID, ENT_QUOTES, 'UTF-8') ?>" />
        <input type="text" name="optionName" placeholder="Option Name" required/>
        <input type="number" name="optionPrice" step="0.5" min="0" placeholder="Option Price" required>
        <input type="submit" value="+" />
    </form> <?php } //Checking if previous products name is same as previous one
       echo "<p>".$optionName . " ". $optionPrice."</p>";
}else{ 
    echo "<h2>".$category. "</h2>";
    ?> 
<form action="<?php $direct->directory("PHP/Admin","menuEdit"); ?>" method="POST">
    <input type="hidden" name="operation" value="addProduct" />
    <input type="hidden" name="categoryID" value="<?= htmlspecialchars($categoryid, ENT_QUOTES, 'UTF-8') ?>" />
    <input type="hidden" name="menuID" value="<?= htmlspecialchars($menuID, ENT_QUOTES, 'UTF-8') ?>" />
    <input type="text" name="productName" placeholder="Product Name" required/>
    <input type="submit" value="+" />

 </form>
<?php
   echo "<h3>".$productName. "</h3>";
    if($productName ==""){}else{
    ?> <form action="<?php $direct->directory("PHP/Admin","menuEdit"); ?>" method="POST">
    <input type="hidden" name="operation" value="addOption" />
    <input type="hidden" name="productID" value="<?= htmlspecialchars($productid, ENT_QUOTES, 'UTF-8') ?>" />
    <input type="hidden" name="categoryID" value="<?= htmlspecialchars($categoryID, ENT_QUOTES, 'UTF-8') ?>" />
    <input type="hidden" name="menuID" value="<?= htmlspecialchars($menuID, ENT_QUOTES, 'UTF-8') ?>" />
    <input type="text" name="optionName" placeholder="Option Name" required/>
    <input type="number" name="optionPrice" step="0.5" min="0" placeholder="Option Price" required>
    <input type="submit" value="+" />
</form> <?php
    echo "<p>".$optionName . " " . $optionPrice."</p>";
    }
}
   
$productNameCheck = $productName;
$categoryCheck = $category;
}
?> 
   <form action="<?php $direct->directory("PHP/Admin","menuEdit"); ?>" method="POST">
        <input type="hidden" name="menuID" value="<?= htmlspecialchars($menuID, ENT_QUOTES, 'UTF-8') ?>" />
        <input type="hidden" name="operation" value="addCategory" /> 
        <input type="text" name="categoryName" placeholder="Category Name" required/>
        <input type="submit" value="+" />

    </form> 
  <?php
  $sql->updateCategoriesOrder();
  $sql->rearrangeCategoriesOrder($menuID);
  ?> 