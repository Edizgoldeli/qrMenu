<?php
include_once "../../PHP/dbConnection.php";
$direct = new Url;
?> 
<a href="<?php $direct->directory("HTML/Admin", "mainMenu"); ?>" title="geri">Geri Git</a> <br><br>
<?php
session_start();
if($_SESSION['ID']){}else{$direct->redirect("HTML/Admin","mainMenu");}
$query = $conn->query("SELECT ID, menuName FROM menu ORDER BY timeStamp DESC", PDO::FETCH_ASSOC);

    foreach ($query as $data) {
        $menuName = $data['menuName'];
        $ID = $data['ID'];
        ?> 
        <form action="<?php $direct->directory("PHP/Admin","menuDetails"); ?>" method="POST">
        <input type="hidden" name="menuID" value="<?= htmlspecialchars($ID, ENT_QUOTES, 'UTF-8') ?>" />
        <input type="submit" value="<?= htmlspecialchars($menuName, ENT_QUOTES, 'UTF-8') ?>" />

    </form>
        <?php
    }