<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 22:31, 7. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Model;

use Nette,
    Nette\Mail,
    Nette\Mail\Message,
    Latte;

class myMailer extends Mail\SmtpMailer
{

    private $mailer;

    private $latteEngine;

    private $message;

    function __construct()
    {
        $this->latteEngine = new Latte\Engine;
        $this->message = new Message;
        $this->mailer = new Nette\Mail\SmtpMailer;


        /*
         In future
         $config = [
            'host' => 'jkotrba.net',
            'port' => '25',
            'username' => 'nugatu',
            'password' => 'cust168255332210',
            'timeout' => '30'
        ];
        */
    }

    public function sendEmail()
    {
        $this->mailer->send($this->message);
    }

    public function setHtmlBody($template, $params)
    {
        $this->message->setHtmlBody($this->latteEngine->renderToString($template, $params));
        return $this;
    }

    public function addTo($target)
    {
        $this->message->addTo($target);
        return $this;
    }

    public function setFrom($email)
    {
        $this->message->setFrom($email);
        return $this;
    }

    public function setSubject($subject)
    {
        $this->message->setSubject($subject);
        return $this;
    }

}