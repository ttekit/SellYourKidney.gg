<?php

namespace App;

use Models\userModel;

class UserAutrntification
{
    private static $user = null;
    public static function isUserValid($email, $password){
        $password = hash("sha256", $password);
        $userM = new UserModel;
        self::$user = $userM->getUserInfo($email, $password);
        return self::$user;
    }
    public static function UserCheck(){
        return self::$user;
    }
}