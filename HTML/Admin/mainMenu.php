<?php  
include_once "../../PHP/dbConnection.php";
$direct = new Url;

?> 
    <form action="<?php $direct->directory("HTML/Admin","currentMenus"); ?>" method="POST">
    <input type="submit" value="Kayıtlı Menüler" />
    </form>
    <form action="<?php $direct->directory("HTML/Admin","activeMenu"); ?>" method="POST">
    <input type="submit" value="Yayınlanan Menü" />
    </form>
 