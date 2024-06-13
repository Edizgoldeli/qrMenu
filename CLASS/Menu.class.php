<?php
class Menu
{

    public function activeMenu()
    {  
        global $conn;
        ?>
        <div class="container"> 
       
    <?php
    
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
            $GLOBALS["menuName"] = $data['menuName']; 
            
            
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
 ?></div> <?php
    }
}