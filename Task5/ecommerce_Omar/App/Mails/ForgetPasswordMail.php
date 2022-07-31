<?php
namespace App\Mails;

use App\Mails\Contracts\Mail;
use PHPMailer\PHPMailer\Exception;

class ForgetPasswordMail extends Mail {
    public function send()
    {
        try {
            //Recipients
            $this->mail->setFrom($this->mailFrom,$this->mailFromName);
            $this->mail->addAddress($this->mailTo);     //Add a recipient
        
            //Content
            $this->mail->isHTML(true);                                  //Set email format to HTML
            $this->mail->Subject = $this->subject;
            $this->mail->Body    = $this->body;
        
            $this->mail->send();
            // echo 'Message has been sent';
            return true;
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
            return false;
        }
    }
}