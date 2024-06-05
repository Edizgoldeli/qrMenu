<?php 
require_once "PHP/dbConnection.php";
session_start();

$direct = new Url;
$p = new Hash;

?>
<a href="<?php $direct->directory("","index"); ?>"><img src="/qrMenu/images/return.png" alt="Geri dön" style="width:50px;height:50px; float: left;"></a>
<div class="box1">

    <form action="<?php $direct->directory("PHP/Admin","login"); ?>" method="POST">
        <input type="email" class="input1" name="mail" placeholder="mail" required>
        <input type="password" class="input2" name="password" placeholder="Password" required>
        <input type="submit" class="submit" value="Giriş Yap">
    </form>
   
</div>