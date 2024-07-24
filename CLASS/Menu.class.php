<?php
class Menu
{
    public function activeMenu()
    {
        global $conn;
        ?>
         
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
                    category.priority ASC, product.productName ASC, options.optionName ASC;
            ");
    
            $stmt->execute(); 
            $categoryCheck = [];
            $productNameCheck = [];
            $currentCategory = null;
            $currentProduct = null;

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

                // Check if the current category is different from the previous one
                if ($currentCategory !== $category) {
                    $currentCategory = $category;
                    $currentProduct = null;
                    echo "<div class='categoryName'>" . $category . "</div><br>";
                }

                // Check if the current product is different from the previous one
                if ($currentProduct !== $productName) {
                    $currentProduct = $productName;
                    echo "<div class='productName'>" . $productName . "</div><br>";
                }

                // Display the option
                if (!empty($optionName)) {
                    echo "<div class='optionContainer'><div class='optionName'>" . ucfirst($optionName) . "</div> <div class='optionPrice'>" . $optionPrice . "₺</div></div><br><br>";
                }
            }
            ?>
        
        <?php
    }
}
