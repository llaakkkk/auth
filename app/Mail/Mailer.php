<?php

namespace App\Mail;

use Slim\Views\Twig as View;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
     protected $view;
    
     protected $mailer;
    
     public function __construct( PHPMailer $mailer, View $view)
     {
         $this->mailer = $mailer;
         $this->view = $view;
     }
    
    public function send($template, $data, $callback)
    {
        $message = new Message($this->mailer);
        
        $message->body($this->view->fetch($template, $data));
        
        call_user_func($callback, $message);

         $this->mailer->send();
    }
}