<?php

namespace App;

class UserAuthorisation
{
    public static function AuthorizedExecute()
    {
        $_SESSION["reg"]["login"] = UserAutrntification::UserCheck()->login;
        $_SESSION["reg"]["user_Id"] = UserAutrntification::UserCheck()->id;
        $_SESSION["reg"]["user_Ip"] = $_SERVER["REMOTE_ADDR"];
        $_SESSION["reg"]["role"] = "admin";
        varDump($_SESSION);
    }

    public static function isUserAuthorized()
    {
        if (isset($_SESSION["reg"])) {
            if ($_SESSION["reg"]["role"] == "admin") {
                return true;
            }
        }
        return false;
    }
}