<?php
include_once __DIR__ . "/../dbConnection.php";
$direct = new Url;
session_start();
if($_SESSION['ID']){}else{$direct->redirect("","index");} 
$menuID = $_POST['menuID']; 
$encode = new Hash;
$sql = new Sql;
$sql->updateStatus($menuID);
$direct->redirect("HTML/Admin", "activeMenu");