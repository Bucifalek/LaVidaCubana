<?php

namespace App\AdminModule\Presenters;

use Nette,
	App\AdminModule\Model,
	Nette\Database;
use Tracy\Debugger;
use Tracy\Dumper;

class supportPresenter extends BasePresenter
{

	public function createComponentContactSupportForm()
	{
		$form = new Nette\Application\UI\myForm;
		$form->addProtection();
		$form->addText('email')
			->setDefaultValue($this->getUser()->getIdentity()->data['email']);
		$form->addTextArea('text')->setRequired('Musíte vyplnit')->setDefaultValue($this->value);
		$form->addSubmit('send');
		$form->onSuccess[] = [$this, 'contactSupportFormSuccess'];

		return $form;
	}

	public function contactSupportFormSuccess(Nette\Forms\Form $form, $values)
	{
		Debugger::barDump('hotovo');
	}
}

