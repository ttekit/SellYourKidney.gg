<?php

namespace Models;

class tags extends \App\DBEngine
{
    public function __construct()
    {
        parent::__construct('tags');

    }
    public function getByPostId($id){
        return $this->executeQuery("SELECT tags.tag FROM posttags LEFT JOIN tags ON tags.id = posttags.tag_id WHERE posttags.post_id =$id");
    }
    public function getAllNotEmptyTegs($count){
        if(!isset($count)){
            $count = 0;
        }
        return $this->executeQuery("SELECT tags.tag FROM tags WHERE tags.countPosts > ".$count);
    }
    public function getIdByTag($tag)
    {
        $result = $this->getId(["post_id" => $tag]);
        if (count($result) > 0) {
            return $result[0];
        }
        return null;
    }


    public function AddTag($tag)
    {

        return parent::addRow([
            'tag' => $tag
        ]);
    }
}