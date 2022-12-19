<?php

namespace App;

class Error extends Controller
{
    public function index(){
        $this->data["title"] = "404";
        View::render(VIEWS_PATH . "noSliderTemplate" . EXT, PAGES_PATH . "main404Error" . EXT, $this->data);
    }
}