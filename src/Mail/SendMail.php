<?php 

namespace Financas\Mail;

use PHPMailer\PHPMailer\PHPMailer;

class SendMail
{
    private PHPMailer $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer();
       
        $this->mail->isSMTP();                                
        $this->mail->Host       = $_ENV['MAIL_HOST'];
        $this->mail->SMTPAuth   = $_ENV['MAIL_SMTP_AUTH'];               
        $this->mail->Username   = $_ENV['MAIL_USERNAME'];       
        $this->mail->Password   = $_ENV['MAIL_PASSWORD'];                
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port       = $_ENV['MAIL_POST'];     
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