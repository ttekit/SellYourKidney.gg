<?php

namespace App;
class ClientError extends Controller
{
    public function index()
    {
        $this->format_options();
        $this->data["title"] = "Error";
        View::render(VIEWS_PATH . "template" . EXT, PAGES_PATH . "mainError" . EXT, $this->data);
    }

}