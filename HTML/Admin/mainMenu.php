
<?php  
include_once "../../PHP/dbConnection.php";
$direct = new Url;
session_start();
if($_SESSION['ID']){}else{$direct->redirect("","index");}

?> <a href="<?php $direct->directory("PHP/Admin", "logout"); ?>" title="Login">Çıkış Yap</a> <br><br>
    <form action="<?php $direct->directory("HTML/Admin","currentMenus"); ?>" method="POST">
    <input type="submit" value="Kayıtlı Menüler" />
    </form>
    <form action="<?php $direct->directory("HTML/Admin","activeMenu"); ?>" method="POST">
    <input type="submit" value="Yayınlanan Menü" />
    </form> <?php
