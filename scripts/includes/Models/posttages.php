<?php

namespace Models;

class posttages extends \App\DBEngine
{
    public function __construct()
    {
        parent::__construct('posttags');

    }

    public function getByPostId($postId)
    {
        $result = $this->getManyRows(["post_id" => $postId]);
        if (count($result) > 0) {
            return $result;
        }
        return null;
    }


    public function AddElem($post_id, $tag_id)
    {
        return parent::addRow([
            'post_id' => $post_id,
            'tag_id' => $tag_id,
        ]);
    }
}