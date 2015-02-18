<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 16:25, 9. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette,
	App\AdminModule\Model;

/**
 * Class TestPresenter
 * @package App\AdminModule\Presenters
 */
class testPresenter extends BasePresenter
{

	/**
	 *
	 */

	public function handleSendEmail()
	{
		// send test email to jan.kotrbaa@gmail.com

		$myMailer = new Model\myMailer;
		//$myMailer->setHtmlBody(__DIR__ . '/../templates/EmailTemplates/test.latte', [])
		$myMailer->setHtmlBody(__DIR__ . '/../templates/EmailTemplates/newUserEmail.latte', [null])
			->addTo('jan.kotrbaa@gmail.com')
			->setFrom("cms@pizzeriaitaliana.cz")
			->setSubject("Testovani sablon!");
		$myMailer->sendEmail();
		$this->flashMessage('Email odeslan.', FLASH_SUCCESS);
		$this->redirect('Test:sendEmail');
	}
}