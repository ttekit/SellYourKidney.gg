<?php

namespace Models;

class mailingList extends \App\DBEngine
{
    public function __construct()
    {
        parent::__construct("subscribers");
    }

    public function addEmail($email)
    {
        return $this->addRow(["email"=>$email]);
    }
    public function getAllEmails()
    {
        return $this->getManyRows();
    }

    public function sendAllEmails()
    {
        $mailM = new mailingList();
        $subject = "test";
        $message = "test";
        foreach ($mailM->getAllEmails() as $key=>$email){
            mail
            (
                $email,
                $subject,
                $message,
                'From: gofukcyoursself@gmail.com'
            );
        }
    }
}