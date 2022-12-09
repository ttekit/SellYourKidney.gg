<?php





namespace Models;

use PHPMailer\PHPMailer\PHPMailer;

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