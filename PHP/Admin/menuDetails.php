<form action="<?php echo $_SERVER['HTTP_REFERER']; ?>" method="get">
        <button type="submit">Go Back</button>
    </form>
<?php
include_once __DIR__ . "/../dbConnection.php";
$direct = new Url;
$menuID = $_POST["menuID"]; //Selected menu's ID from previous page

$stmt = $conn->prepare("
SELECT 
    menu.ID as menuID,
    category.categoryName, 
    product.productName, 
    product.categoryID,
    options.optionName, 
    options.optionPrice,
    options.productID
    

FROM 
    menu
JOIN 
    category ON category.menuID = menu.ID
JOIN 
    product ON product.categoryID = category.ID
JOIN 
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
$productID = $data['productID'];

if($category == $categoryCheck){ // Checking if previous products category is same as this product
    if($productName != $productNameCheck){ echo $productName. "<br><br>";} //Checking if previous products name is same as previous one
       echo $optionName . " ". $optionPrice."<br>";
}else{ 
    echo "<br>".$category. "<br>";
    ?> 
<form action="<?php $direct->directory("PHP/Admin","menuDetails"); ?>" method="POST">
     <input type="hidden" name="categoryID" value="<?= htmlspecialchars($categoryID, ENT_QUOTES, 'UTF-8') ?>" />
     <input type="hidden" name="menuID" value="<?= htmlspecialchars($menuID, ENT_QUOTES, 'UTF-8') ?>" />
     <input type="submit" value="Ürün Ekle" />

 </form>
<?php
    echo $productName;
    ?> <form action="<?php $direct->directory("PHP/Admin","menuDetails"); ?>" method="POST">
    <input type="hidden" name="productID" value="<?= htmlspecialchars($productID, ENT_QUOTES, 'UTF-8') ?>" />
    <input type="hidden" name="categoryID" value="<?= htmlspecialchars($categoryID, ENT_QUOTES, 'UTF-8') ?>" />
    <input type="hidden" name="menuID" value="<?= htmlspecialchars($menuID, ENT_QUOTES, 'UTF-8') ?>" />
    <input type="submit" value="Opsiyon Ekle" />
</form> <?php
    echo $optionName . " " . $optionPrice."<br>";
    
}
   
$productNameCheck = $productName;
$categoryCheck = $category;
}
?> 
   <form action="<?php $direct->directory("PHP/Admin","menuDetails"); ?>" method="POST">
        <input type="hidden" name="menuID" value="<?= htmlspecialchars($menuID, ENT_QUOTES, 'UTF-8') ?>" />
        <input type="submit" value="Yeni Kategori Ekle" />

    </form> 
  