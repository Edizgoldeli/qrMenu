<?php 
require_once "PHP/dbConnection.php";
$sql = new Sql;
$direct = new Url;  
$menu = new Menu;?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel=stylesheet href="<?php $direct->directoryGeneral("CSS/Admin", "activeMenu", "css"); ?>" />
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
    <title>Menu</title>

</head>
<body>
<?php
  $menu->activeMenu(); 
    
    ?>
</body>
</html>
 