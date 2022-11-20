<?php

namespace Models;
class comments extends \App\DBEngine
{
    public function __construct()
    {
        parent::__construct("blogposts");
    }

    public function getAllComentsUnderPost($postId)
    {
        return $this->getManyRows([
            "post_id"=>$postId
        ]);
    }
    public function getById($id){
       return parent::executeQuery("SELECT * FROM comments WHERE post_id = $id AND comment_id IS NULL");
    }
    public function makeNewComment($login, $email, $comment, $dateOfComment, $client_ip)
    {
        return $this->addRow([
            "login"=>$login,
            "email"=>$email,
            "comment"=>$comment,
            "dateOfComment"=>$dateOfComment,
            "verified"=>false,
            "client_ip"=>$client_ip
        ]);
    }
    public function insertNewComment($postId, $login, $email, $comment, $commentId){
        if($commentId == null){
            $commentId="null";
        }

        return parent::executeQuery("INSERT INTO comments(post_id, login, email, `comment`, comment_id) VALUES($postId,'$login','$email','$comment', $commentId)");
    }
    public function getSubCommentsBParentId($parentId){
        return parent::executeQuery("SELECT * FROM comments WHERE comment_id =".$parentId);
    }
}
