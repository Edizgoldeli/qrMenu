<?php 
require_once "PHP/dbConnection.php";
$sql = new Sql;
$direct = new Url;  
$menu = new Menu;?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel=stylesheet href="<?php $direct->directoryGeneral("CSS/Admin", "activeMenu", "CSS"); ?>" />
    <script src='main.js'></script>
</head>
<body>
<?php
  $menu->activeMenu(); 
    
    ?>
</body>
</html>
 