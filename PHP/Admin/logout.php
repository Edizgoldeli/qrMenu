<?php
include_once __DIR__ . "/../dbConnection.php";
session_start();

unset($_SESSION['ID']);

$a = new Url;
$a->redirect("PHP/Admin","login");