<?php
include_once __DIR__ . "/../dbConnection.php";


session_start();
$mail = $_POST['mail'];
$password = $_POST['password'];

$encode = new Hash;
$direct = new Url;
$sorgu = $conn->query("SELECT * from users where mail = '$mail' ", PDO::FETCH_ASSOC);


    foreach ($sorgu as $veri) {
        $passwordHash = $veri['password'];

        if ($encode->verify($password, $passwordHash)) {
            $ID =  $veri['ID'];
            $mail = $veri['mail'];
            $_SESSION['ID'] = $ID;
            echo "Hoşgeldiniz.";
            $direct->redirect("HTML/Admin", "mainMenu");
            die();
        }else{
            $direct->redirect("", "index");
        }
    }
    $direct->redirect("", "index");