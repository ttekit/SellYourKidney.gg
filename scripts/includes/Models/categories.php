<?php

namespace Models;

class categories extends \App\DBEngine
{
    public function __construct()
    {
        parent::__construct('categories');

    }

    public function getCategoryByCategoryName($category)
    {
        $result = $this->getManyRows(["category" => $category]);
        if (count($result) > 0) {
            return $result[0];
        }
        return null;
    }
    public function getCategoryByPostId($id)
    {
        $result = $this->executeQuery("SELECT categories.category FROM blogcategories  
LEFT JOIN categories ON categories.id = blogcategories.category_id 
WHERE blogcategories.post_id = $id");
        return $result;
    }

    public function AddCategory($category)
    {
        return parent::addRow([
            'category' => $category,
        ]);
    }
    public function getAllNotEmptyCategories(){
        return $this->executeQuery("SELECT categories.category FROM categories WHERE categories.countPosts > 0");
    }
    public function getAllCategories(){
        return $this->executeQuery("SELECT * FROM categories");
    }
}