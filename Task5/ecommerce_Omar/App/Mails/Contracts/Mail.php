<?php
namespace App\Mails\Contracts;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

abstract class Mail {
    protected string $mailHost = 'smtp-mail.outlook.com';
    protected int $mailPort = 587;
    protected string $mailEncryption = 'tls';
    protected string $mailFrom = 'ntib20@hotmail.com';
    protected string $mailFromPassword = 'Nti12345';
    protected PHPMailer $mail;
    protected string $mailTo,$subject,$body,$mailFromName;
    
    public function __construct($mailTo,$subject,$body,$mailFromName = 'ecommerce') {
        $this->mailTo = $mailTo;
        $this->subject = $subject;
        $this->body = $body;
        $this->mailFromName = $mailFromName;

        $this->mail = new PHPMailer(true);
        //Server settings
        $this->mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $this->mail->isSMTP();                                            //Send using SMTP
        $this->mail->Host       = $this->mailHost;                     //Set the SMTP server to send through
        $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $this->mail->Username   = $this->mailFrom;                     //SMTP username
        $this->mail->Password   = $this->mailFromPassword;                               //SMTP password
        $this->mail->SMTPSecure = $this->mailEncryption;            //Enable implicit TLS encryption
        $this->mail->Port       = $this->mailPort;      

    }
    protected abstract function send();
}

