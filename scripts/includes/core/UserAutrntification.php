<?php

namespace App;

use Models\admin;

class UserAutrntification
{
    private static $user = null;
    public static function isUserValid($email, $password){
        $password = hash("sha256", $password);
        $userM = new admin;
        self::$user = $userM->getAdminInfo($email, $password);
        return self::$user;
    }
    public static function UserCheck(){
        return self::$user;
    }
}