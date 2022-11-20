<?php

namespace App;
class Main extends Controller
{
    public function index(){
        $this->format_options();
        $this->returnNavigationPanel();
        $this->format_products();
        View::render(VIEWS_PATH."template".EXT, PAGES_PATH."mainIndex".EXT, $this->data);
    }

    private function format_products(){
        $pm = new \Models\products();
        $this->data["products"] = $pm->execQuery("SELECT * FROM products ORDER BY price DESC LIMIT 6 OFFSET 0");
        unset($pm);
    }
}