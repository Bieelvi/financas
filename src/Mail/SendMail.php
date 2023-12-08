<?php 

namespace Financas\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class SendMail
{
    private PHPMailer $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer();

        $this->mail->SMTPDebug  = SMTP::DEBUG_SERVER;         
        $this->mail->isSMTP();                                
        $this->mail->Host       = 'smtp.gmail.com';
        $this->mail->SMTPAuth   = true;                       
        $this->mail->Username   = 'bieelvii13@gmail.com';         
        $this->mail->Password   = 'pqzm xfau yvkr zbbo';                   
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port       = 465;         
        $this->mail->SMTPDebug  = SMTP::DEBUG_OFF;
    }

    public function send(Mail $mail): void
    {
        $this->mail->setFrom(
            $mail->getFrom(), 
            $mail->getFromName()
        );
        $this->mail->addAddress(
            $mail->getTo(), 
            $mail->getToName()
        );  

        $this->mail->isHTML($mail->getIsHtml()); 

        $this->mail->Subject = $mail->getSubject();
        $this->mail->Body    = $mail->getBody();

        $this->mail->send();
    }
}   