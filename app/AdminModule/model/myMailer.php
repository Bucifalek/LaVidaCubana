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

class myMailer extends Mail\SmtpMailer implements Nette\Mail\IMailer
{

    private $mailer;

    function __construct()
    {
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
        $this->mailer = new Nette\Mail\SmtpMailer;
    }

    public function send(Message $mail)
    {
        $this->mailer->send($mail);
    }

}