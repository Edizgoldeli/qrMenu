<?php
include_once "../../PHP/dbConnection.php";
$direct = new Url;
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.8" />
    <link rel=stylesheet href="<?php $direct->directoryGeneral("CSS/Admin", "menuDetails", "css"); ?>" />
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
    <title>Menu</title>

</head>

<body><?php
include ("../../PHP/Admin/menuDetails.php"); ?></body>

</html>