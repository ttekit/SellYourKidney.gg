<?php

namespace Models;

class admin extends \App\DBEngine
{
    public function __construct()
    {
        parent::__construct("admin");
    }

    public function getAdminInfo($email, $password)
    {
        $result = $this->executeQuery("SELECT * FROM admin WHERE email = '$email' and password = '$password' LIMIT 1");
        if (count($result) == 1) {
            return $result[0];
        }
        return null;
    }
}