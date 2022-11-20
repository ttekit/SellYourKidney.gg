<?php

namespace Models;

class userSocLincs extends \App\DBEngine
{
    public function __construct()
    {
        parent::__construct("admin");
    }

    public function getSocLinksOfUser($id)
    {
        $result = $this->executeQuery("SELECT * FROM usersoclinks WHERE UserId = $id");
        if (isset($result)) {
            return $result;
        }
        return null;
    }
    public function addSocLinkToUser($socLink, $socName, $userId)
    {
        $result = $this->executeQuery("INSERT INTO usersoclinks(SocLink, SocName, UserId) VALUES('$socLink','$socName',$userId)");
        return $result;
    }
    public function removeSocLinkById($id)
    {
        $result = $this->executeQuery("DELETE FROM usersoclinks WHERE Id =".$id);
        return $result;
    }
}