<?php

namespace Models;

class contactInfo extends \App\DBEngine
{
    public function __construct()
    {
        parent::__construct('contactinfo');

    }

    public function getByName($nameOption)
    {
        $result = $this->getManyRows(["name" => $nameOption]);
        if (count($result) > 0) {
            return $result[0];
        }
        return null;
    }
    public function getByEmail($emailOption)
    {
        $result = $this->getManyRows(["name" => $emailOption]);
        if (count($result) > 0) {
            return $result[0];
        }
        return null;
    }
    public function execQuery($query)
    {
        return parent::executeQuery($query);
    }

    public function SaveMessage($name, $email, $message)
    {

        return parent::addRow([
            'name' => $name,
            'email' => $email,
            'message' => $message
        ]);
    }
}