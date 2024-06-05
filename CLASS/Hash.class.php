<?php
class Hash
{
    private $password;

    public function encode($password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        return $password;
    }
    public function verify($password, $hash)
    {
        return password_verify($password, $hash);
       
    }
}