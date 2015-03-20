<?php

namespace App\AdminModule\Presenters;

use Nette,
	App\AdminModule\Model,
	Nette\Database;
use Tracy\Debugger;
use Tracy\Dumper;

/**
 * Class SupportPresenter
 * @package App\AdminModule\Presenters
 */
final class SupportPresenter extends BasePresenter
{

	/**
	 * @var
	 */
	private $userEmail;

	public function renderContact()
	{
		$this->userEmail = $this->getUser()->getIdentity()->data['email'];
		$this->template->userEmail = $this->userEmail;
	}

	/**
	 * @return Nette\Application\UI\myForm
	 */
	public function createComponentContactSupportForm()
	{
		$form = new Nette\Application\UI\myForm;
		$form->addProtection();
		$form->addText('email')->setDefaultValue($this->userEmail);
		$form->addTextArea('text')->setRequired('Musíte vyplnit');
		$form->addSubmit('send');
		$form->onSuccess[] = [$this, 'contactSupportFormSuccess'];

		return $form;
	}

	/**
	 * @param Nette\Forms\Form $form
	 * @param $values
	 */
	public function contactSupportFormSuccess(Nette\Forms\Form $form, $values)
	{
		Debugger::barDump('hotovo');
	}
}

