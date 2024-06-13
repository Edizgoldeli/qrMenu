<?php
include_once "../../PHP/dbConnection.php";
$sql = new Sql;
$direct = new Url;  
$menu = new Menu; 

?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel=stylesheet href="<?php $direct->directoryGeneral("CSS/Admin", "activeMenu", "css"); ?>" />
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
    <title>Menu</title>

</head>

<body> <a href="<?php $direct->directory("HTML/Admin", "mainMenu"); ?>" title="geri">Geri Git</a> <br><br>
        <?php
        session_start();
        if ($_SESSION['ID']) {
        } else {
            $direct->redirect("", "index");
        }
    
    
    $menu->activeMenu(); 
    $menuID = $GLOBALS["ID"]; // $menuID is declared as GLOBAL in activeMenu()
    $menuName = $GLOBALS["menuName"]; // $menuName is declared as GLOBAL in activeMenu()
    echo "Görüntülenen Menü: $menuName <br>";
    ?>        
    Aktif Menüyü Değiştir 
   <?php
   $query = $conn->query("SELECT ID, menuName FROM menu ORDER BY timeStamp DESC", PDO::FETCH_ASSOC);

   foreach ($query as $data) {
       $menuName = $data['menuName'];
       $ID = $data['ID'];

       ?>
       <form action="<?php $direct->directory("PHP/Admin", "activeMenu"); ?>" method="POST">
           <input type="hidden" name="menuID" value="<?= htmlspecialchars($ID, ENT_QUOTES, 'UTF-8') ?>" />
           <input type="submit" value="<?= htmlspecialchars($menuName, ENT_QUOTES, 'UTF-8') ?>" />

       </form>
       <?php
   }
?>
    Kategori Sıralamasını Değiştir<?php
    $sql->updateCategoriesOrder();
    $sql->rearrangeCategoriesOrder($menuID);
    ?>

    <br>
    <br>
    <br> </body> 
    </html>