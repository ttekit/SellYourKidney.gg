<?php

namespace App;

use Controllers;

class Router
{
    private $defaultControllerName = __NAMESPACE__ . "\\" . "Main";
    private $errorControllerName = __NAMESPACE__ . "\\" . "Error";
    private $defaultActionName = 'index';

    private $controllerName = null;
    private $actionName = null;

    private $controller = null;

    public function start()
    {
        $route = explode("?", $_SERVER["REQUEST_URI"])[0];
        $routes = explode("/", $route);
        if (empty($routes[1])) {
            $this->controllerName = $this->defaultControllerName;
        } else {
            //choose controller
            $this->controllerName = ucfirst(mb_strtolower($routes[1]));

            if (file_exists(CONTROL_PATH . $this->controllerName . EXT)) {
                $this->controllerName = __NAMESPACE__ . "\\" . $this->controllerName;
            } else {
                $this->controllerName = $this->errorControllerName;
            }

        }
        $this->controller = new $this->controllerName();
        $this->actionName = $this->defaultActionName;
        if (!empty($routes[1])) {
            if(!empty($routes[2])){
                if (method_exists($this->controller, mb_strtolower($routes[2]))) {
                    $this->actionName = mb_strtolower($routes[2]);
                }
            }
        }
        $this->controller->call($this->actionName);
    }
}