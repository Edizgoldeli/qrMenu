<?php
function classes($class)
{
    $adress = $_SERVER['DOCUMENT_ROOT'] . "/qrMenu/CLASS/". $class . ".class.php";
    require_once($adress);
}
spl_autoload_register("classes");