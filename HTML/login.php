<?php 
include_once "../PHP/dbConnection.php";
$direct = new Url;
session_start();

if($_SESSION['ID'] ?? null){ $direct->redirect("HTML/Admin","mainMenu"); }else{
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=0.8" /> 
        <link rel= stylesheet  href="<?php $direct->directoryGeneral("CSS/Admin","login","CSS"); ?>" />
        <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
        <title>Menu</title>
        
    </head>

 <body>

   <div class="box1">
   <img src="<?php echo $direct->directoryGeneral("images","logo","png"); ?>" alt="Login Image" draggable="false" onmousedown="return false;">
    <H1>TAKAGU</H1>
    <form action="<?php $direct->directory("PHP/Admin","login"); ?>" method="POST">
        <input class="input-box1" type="email" class="input1" name="mail" placeholder="Mail" required><br>
        <input class="input-box2" type="password" class="input2" name="password" placeholder="Password" required><br><br>
        <input class="submit-button1" type="submit" class="submit" value="Giriş Yap">
    </form>
   
</div> 

 <?php }
 ?>
  </body>
  </html>