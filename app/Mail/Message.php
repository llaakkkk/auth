<?php

namespace App\Mail;

use PHPMailer\PHPMailer\PHPMailer;

class Message
{
    protected $mailer;
    
    public function __construct(PHPMailer $mailer)
    {
        $this->mailer = $mailer;
    }
    
    public function to($address)
    {
        $this->mailer->addAddress($address);   
    }
    public function subject($subject)
    {
        $this->mailer->Subject = $subject;
    }
    public function body($body)
    {
        $this->mailer->Body = $body;
    }
    public function from($from)     // if you want to add different sender email in mailer call.
    {
        $this->mailer->From = $from;
    }
    public function fromName($fromName) // if you want to add different sender name in mailer call.
    {
        $this->mailer->FromName = $fromName;
    }
}