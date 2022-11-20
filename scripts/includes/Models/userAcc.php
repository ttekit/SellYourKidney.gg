<?php

namespace Models;

class userAcc extends \App\DBEngine
{
    public function __construct()
    {
        parent::__construct('userAcc');
    }
    public function getById($Id)
    {
        $result = $this->getManyRows(["id" => $Id]);
        if (count($result) > 0) {
            return $result;
        }
        return null;
    }
    public function getByEmail($email)
    {
        $result = $this->getOneRow(["email" => $email]);
        if (count($result) > 0) {
            return $result;
        }
        return null;
    }
    public function getByLogin($login)
    {
        $result = $this->getOneRow(["login" => $login]);
        if (count($result) > 0) {
            return $result;
        }
        return null;
    }
    public function AddNewUser($data)
    {
        return parent::addRow($data);
    }
    public function updateUserData($userId, $data)
    {
        return parent::updateRow($userId, $data);
    }
    public function removeUser($userId){
        return parent::removeRow($userId);
    }
}