<?php
require 'PHPMailerAutoload.php';
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

    public function sendAllEmails($subject, $message)
    {
        $mailM = new mailingList();

        $message = str_replace("\n.", "\n..", $message);
        $message = wordwrap($message, 70, "\r\n");

        foreach ($mailM->getAllEmails() as $key=>$email){
            $res = mail
            (
                $email,
                $subject,
                $message
            );
            if($res === false){
                return false;
            }
        }
        return true;
    }
}