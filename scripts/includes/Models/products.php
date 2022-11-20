<?php

namespace Models;

class products extends \App\DBEngine
{
    public function __construct()
    {
        parent::__construct('products');

    }

    public function getById($id)
    {
        $result = $this->getOneRow(["id" => $id]);
        if ($result != null) {
            return $result;
        }
        return null;
    }
    public function getAllProducts()
    {
        $result = $this->getManyRows();
        if (count($result) > 0) {
            return $result;
        }
        return null;
    }

    public function execQuery($query)
    {
        return parent::executeQuery($query);
    }

    public function AddProduct($name, $img_src, $img_alt, $price, $content)
    {
        return parent::addRow([
            'name' => $name,
            'img_src' => $img_src,
            'img_alt' => $img_alt,
            'content' => $content,
            'price' => $price
        ]);
    }
    public function UpdateImagePathOfPostById($id, $path)
    {
        return parent::updateRow($id, [
            "img_src" => $path
        ]);
    }
    public function deleteProduct($id){
        return $this->removeRow($id);
    }
}