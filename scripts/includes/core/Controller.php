<?php

namespace App;

use Models\options;
use Models\Navigate;

abstract class Controller
{
    protected $data = [];

    public function __construct()
    {
        $this->data["error"] = null;
        $this->data["success"] = null;
        $this->data["message"] = null;
        $this->data["cart"] = [];

        $this->format_options();
        $this->returnNavigationPanel();
    }

    abstract function index();

    public function call($method)
    {
        if (method_exists($this, $method)) {
            $this->$method();
        }
    }

    protected function format_options()
    {

        $optModel = new options();
        $this->data["options"] = $optModel->getManyRows();
        foreach ($optModel->getManyRows() as $key => $value) {
            $this->data["options"][$value["name"]] = $value["value"];
        }
        unset($optModel);
    }

    public function returnNavigationPanel()
    {
        $navModel = new Navigate();
        $this->data["navigation"] = [];
        $result = $navModel->getNavigateData();
        foreach ($result as $key => $navElem) {
            if(is_null($navElem["parent_id"])){
                $navElem["childs"] = [];
                array_push($this->data["navigation"], $navElem);
            }
        }
        foreach ($this->data["navigation"] as $parentId =>$parent){
            foreach ($result as $childId => $child) {
                if($child["parent_id"] == $parent["Id"] && $child["parent_id"] != null){
                    array_push($this->data["navigation"][$parentId]["childs"], $child);
                }
            }
        }
        unset($navModel);
    }
    public function addProductToCart()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            varDump($this->data["cart"]);
            array_push($this->data["cart"], $_POST["prodId"]);
            varDump($this->data["cart"]);
        }
    }
}
