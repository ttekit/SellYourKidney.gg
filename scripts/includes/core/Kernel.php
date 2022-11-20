<?php

namespace App;

class Kernel
{
    public static $router;
    public static function init($configFilePath){
        self::$router = new Router();
        self::$router->start();
        //        require_once $configFilePath;
    }

}