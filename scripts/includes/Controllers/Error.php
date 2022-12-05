<?php

namespace App;

class Error extends Controller
{
    public function index(){
        $this->data["title"] = "404";
        echo "<div class='text-center p-0 m-0 h-100 font-monospace display-1'>ERROR 404 </div>";
    }
}