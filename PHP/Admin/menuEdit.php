<?php
include_once __DIR__ . "/../dbConnection.php";
session_start();
if($_SESSION['ID']){}else{$direct->redirect("","index");}
$_SESSION['menuID'] = $_POST["menuID"]; 
$direct = new Url;
$menuID = $_POST["menuID"] ?? null;
$categoryID = $_POST["categoryID"] ?? null;
$productID = $_POST["productID"] ?? null;
$optionName = $_POST["optionName"] ?? null;
$productName = $_POST["productName"] ?? null;
$optionPrice = $_POST["optionPrice"] ?? null;
$categoryName = $_POST["categoryName"] ?? null;
$operation = $_POST["operation"] ?? null;
$menuName = $_POST["menuName"] ?? null;

if(isset($menuName)){
    $status = 0;
    $sql = "INSERT INTO menu (menuName, status) VALUES (:menuName, :status)";
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    // Bind the parameters to the placeholders
    $stmt->bindParam(':menuName', $menuName, PDO::PARAM_STR);
    $stmt->bindParam(':status', $status, PDO::PARAM_INT);
    // Execute the statement
    $stmt->execute();
    $direct->redirect("HTML/Admin", "currentMenus");
    die();
} else if(isset($menuID)){
if($operation =="addProduct")
{
    $sql = "INSERT INTO product (categoryID, productName) VALUES (:categoryID, :productName)";
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    // Bind the parameters to the placeholders
    $stmt->bindParam(':categoryID', $categoryID, PDO::PARAM_INT);
    $stmt->bindParam(':productName', $productName, PDO::PARAM_STR);
    // Execute the statement
    $stmt->execute();
    $direct->redirectGET("PHP/Admin", "menuDetails","menuID","$menuID");
    die();
}
if($operation =="addOption")
{
    $sql = "INSERT INTO options (productID, optionName, optionPrice) VALUES (:productID, :optionName, :optionPrice)";
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    // Bind the parameters to the placeholders
    $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
    $stmt->bindParam(':optionName', $optionName, PDO::PARAM_STR);
    $stmt->bindParam(':optionPrice', $optionPrice, PDO::PARAM_INT);
    // Execute the statement
    $stmt->execute();
    $direct->redirectGET("PHP/Admin", "menuDetails","menuID","$menuID");
    die();
}
if($operation =="addCategory")
{
        $sql = "INSERT INTO category (menuID, categoryName) VALUES (:menuID, :categoryName)";
        // Prepare the statement
        $stmt = $conn->prepare($sql);
        // Bind the parameters to the placeholders
        $stmt->bindParam(':menuID', $menuID, PDO::PARAM_INT);
        $stmt->bindParam(':categoryName', $categoryName, PDO::PARAM_STR);
        // Execute the statement
        $stmt->execute();
        $direct->redirectGET("PHP/Admin", "menuDetails","menuID","$menuID");
        die();
}}
    $direct->redirectGET("PHP/Admin","menuDetails");
    die();
