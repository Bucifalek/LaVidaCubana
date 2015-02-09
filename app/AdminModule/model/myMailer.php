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
        $config = [
            'smtp' => true,
            'host' => 'smtp-78628.m28.wedos.net',
            'port' => '465',
            'secure' => 'ssl',
            'username' => 'cms@pizzeriaitaliana.cz',
            'password' => 'cust168255332210'
        ];
        $this->mailer = new Nette\Mail\SmtpMailer($config);
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