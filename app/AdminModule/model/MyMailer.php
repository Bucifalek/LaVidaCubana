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

/**
 * Class MyMailer
 * @package App\AdminModule\Model
 */
final class MyMailer extends Nette\Mail\SmtpMailer implements Mail\IMailer
{

	/**
	 * @var Mail\SmtpMailer
	 */
	private $mailer;

	/**
	 * @var Latte\Engine
	 */
	private $latteEngine;

	/**
	 * @var Message
	 */
	private $message;

	/**
	 *
	 */
	function __construct()
	{
		$this->latteEngine = new Latte\Engine;
		$this->message = new Message;
		$config = [
			'smtp'     => true,
			'host'     => 'smtp-93282.m82.wedos.net',
			'port'     => '465',
			'secure'   => 'ssl',
			'username' => 'upozorneni@kotyslab.cz',
			'password' => '45tteEnginerenderdas97657'
		];
		$this->mailer = new Nette\Mail\SmtpMailer($config);
	}

	/**
	 * @throws Mail\SmtpException
	 * @throws \Exception
	 */
	public function sendEmail()
	{
		$this->mailer->send($this->message);
	}

	/**
	 * @param $template
	 * @param $params
	 * @return $this
	 * @throws \Exception
	 */
	public function setHtmlBody($template, $params)
	{
		$this->message->setHtmlBody($this->latteEngine->renderToString($template, $params));

		return $this;
	}

	/**
	 * @param $target
	 * @return $this
	 */
	public function addTo($target)
	{
		$this->message->addTo($target);

		return $this;
	}

	/**
	 * @param $email
	 * @return $this
	 */
	public function setFrom($email)
	{
		$this->message->setFrom($email);

		return $this;
	}

	/**
	 * @param $subject
	 * @return $this
	 */
	public function setSubject($subject)
	{
		$this->message->setSubject($subject);

		return $this;
	}
}
