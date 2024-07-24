<?php
class Url
{
    public $file;
    public $address;

    public function directory($file, $address) //to call php files
    {
        if ($file == "") {
            $result = "/qrMenu/$address.php";
        } else {
            $result = "/qrMenu/$file/$address.php";
        }
        echo $result;
    }
    public function directoryGeneral($file, $address, $type) //to call any type of files
    {
        if ($file == "") {
            $result = "/qrMenu/$address.$type";
        } else {
            $result = "/qrMenu/$file/$address.$type";
        }
        echo $result;
    }

    public function redirect($file, $address)
    {
        if ($file == "") {
            $result = "/qrMenu/$address.php";
        } else {
            $result = "/qrMenu/$file/$address.php";
        }
        header('Location: ' . $result);
    }
    public function redirectGET($file, $address, $GET, $GETvalue)
    {
        if ($file == "") {
            $result = "/qrMenu/$address.php?$GET=$GETvalue";
        } else {
            $result = "/qrMenu/$file/$address.php";
        }
        header('Location: ' . $result);
    }
  
}