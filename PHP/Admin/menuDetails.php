<form action="<?php echo $_SERVER['HTTP_REFERER']; ?>" method="get">
        <button type="submit">Go Back</button>
    </form>
<?php
include_once __DIR__ . "/../dbConnection.php";

$menuID = $_POST["menuID"]; //Selected menu's ID from previous page

$stmt = $conn->prepare("
SELECT 
    menu.ID as menuID,
    category.categoryName, 
    product.productName, 
    options.optionName, 
    options.optionPrice
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

if($category == $categoryCheck){ // Checking if previous products category is same as this product
    if($productName != $productNameCheck){ echo $productName. "<br><br>";} //Checking if previous products name is same as previous one
       echo $optionName . " ". $optionPrice."<br>";
}else{ 
    echo "<br>".$category. "<br>";
    echo $productName;
    echo "<br>" . $optionName . " " . $optionPrice."<br>";
}
   
    


$productNameCheck = $productName;
$categoryCheck = $category;
}
// while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

//     echo "Menu ID: " . $row['menuID'] . "<br>";
//     echo "Category Name: " . $row['categoryName'] . "<br>";
//     echo "Product Name: " . $row['productName'] . "<br>";
//     echo "Option Name: " . $row['optionName'] . "<br>";
//     echo "Option Price: " . $row['optionPrice'] . "<br><br>";
// }