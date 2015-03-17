<?php

namespace App\AdminModule\Presenters;

use Nette,
	App\AdminModule\Model,
	Nette\Database;
use Tracy\Debugger;
use Tracy\Dumper;

final class SupportPresenter extends BasePresenter
{

	private $userEmail;

	public function renderContact() {
		$this->userEmail = $this->getUser()->getIdentity()->data['email'];
		$this->template->userEmail = $this->userEmail;
	}

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

	public function contactSupportFormSuccess(Nette\Forms\Form $form, $values)
	{
		Debugger::barDump('hotovo');
	}
}

