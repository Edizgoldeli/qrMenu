<?php  
include_once "../../PHP/dbConnection.php";
$direct = new Url; ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=0.8" /> 
        <link rel= stylesheet  href="<?php $direct->directoryGeneral("CSS/Admin","mainMenu","CSS"); ?>" />
        <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
        <title>Menu</title>
        
    </head>

 <body>
<?php
session_start();
if($_SESSION['ID']){}else{$direct->redirect("","index");}

?> <a href="<?php echo $direct->directory("PHP/Admin", "logout"); ?>" title="Çıkış Yap">
<img src="<?php echo $direct->directoryGeneral("images", "goBackArrow", "png"); ?>" alt="Geri Git">
</a><br>
<div class ="centered-div">
    <form action="<?php $direct->directory("HTML/Admin","currentMenus"); ?>" method="POST">
    <input type="submit" value="Kayıtlı Menüler" />
    </form><br>
    <form action="<?php $direct->directory("HTML/Admin","activeMenu"); ?>" method="POST">
    <input type="submit" value="Yayınlanan Menü" />
    </form></div> </body> </html><?php
