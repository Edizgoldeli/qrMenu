<?php
class Url
{
    public $file;
    public $address;

   public function directory($file, $address)
   {
       if ($file == "") {
           $result = "/qrMenu/$address.php";
       } else {
           $result = "/qrMenu/$file/$address.php";
       }
       echo $result;
   }

   public function redirect($file, $address){
    if ($file == "") {
        $result = "/qrMenu/$address.php";
    } else {
        $result = "/qrMenu/$file/$address.php";
    }
    header('Location: '.$result); 
   }

}