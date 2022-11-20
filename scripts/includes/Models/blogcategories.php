<?php

namespace Models;

class blogcategories extends \App\DBEngine
{
    public function __construct()
    {
        parent::__construct('blogcategories');

    }

    public function getByPostId($postId)
    {
        $result = $this->getManyRows(["post_id" => $postId]);
        if (count($result) > 0) {
            return $result;
        }
        return null;
    }


    public function AddElem($post_id, $category_id)
    {

        return parent::addRow([
            'post_id' => $post_id,
            'category_id' => $category_id,
        ]);
    }
}