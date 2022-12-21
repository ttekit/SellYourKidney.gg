<?php

namespace App;

class Products extends Controller
{
    public function index()
    {
        $this->format_options();
        $this->returnNavigationPanel();

        $this->data["title"] = "Products";

        if (isset($_GET["page"]) && is_numeric($_GET["page"])) {
            $this->data["page"] = $_GET["page"];
        } else {
            $this->data["page"] = 1;
        }

        if (isset($_GET["count"]) && is_numeric($_GET["count"])) {
            $this->data["count"] = $_GET["count"];
        } else {
            $this->data["count"] = 12;
        }

        $this->format_products();

        $num = $this->data["productsCount"] / $this->data["count"];
        $this->data["pageCount"] = roundToBigger($num);
        View::render(VIEWS_PATH . "template" . EXT, PRODUCTS_PAGES_PATH . "mainProducts" . EXT, $this->data);
    }

    public function product()
    {
        if (isset($_GET["device"])) {
            $this->data["error"] = null;
            $devId = $_GET["device"];
            $prodM = new \Models\products();
            $onePost = $prodM->getById($devId);
            if (!is_null($onePost)) {
                $this->data["pageData"] = $onePost;
                $this->format_options();
                $this->returnNavigationPanel();
                $this->data["title"] = $onePost["name"];
                View::render(VIEWS_PATH . "template" . EXT, PRODUCTS_PAGES_PATH . "pageProduct" . EXT, $this->data);
            }
        }
    }

    public function favorites()
    {
        $this->format_options();
        $this->returnNavigationPanel();
        $this->data["title"] = "Favorites";
        View::render(VIEWS_PATH . "template" . EXT, PRODUCTS_PAGES_PATH . "pageFavorites" . EXT, $this->data);
    }

    private function format_products()
    {
        $pm = new \Models\products();

        $this->data["products"] = $pm->execQuery("SELECT * FROM products LIMIT " . $this->data["count"] . " OFFSET " . (($this->data["page"] - 1) * $this->data["count"]));
        $this->data["productsCount"] = $pm->executeQuery("SELECT COUNT(*) FROM products")[0]["COUNT(*)"];
        $this->data["maxPrice"] = $pm->executeQuery("SELECT MAX(products.price) FROM products")[0]["MAX(products.price)"];
        $this->data["minPrice"] = $pm->executeQuery("SELECT MIN(products.price) FROM products")[0]["MIN(products.price)"];
        echo $this->data["maxPrice"];
        unset($pm);
    }

}