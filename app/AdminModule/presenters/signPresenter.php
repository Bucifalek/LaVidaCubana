<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 18:23, 4. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette,
	App\AdminModule\Model,
	Nette\Application\UI;

/**
 * Class SignPresenter
 * @package App\AdminModule\Presenters
 */
final class SignPresenter extends BasePresenter
{

	/** @persistent */
	public $backlink;


	public function renderIn()
	{
		if ($this->getUser()->isLoggedIn()) {
			$this->redirect('Dashboard:default');
		}
	}

	public function renderForgot()
	{
		//$this->flashMessage('Email s žádostí o nové heslo odeslán.', FLASH_SUCCESS);
	}

	/**
	 * @return UI\Form
	 */
	protected function createComponentLoginForm()
	{
		$form = new UI\Form;
		$form->addProtection();
		$form->addText('username', 'Name:')
			->setRequired('Nezadali jste jméno.');

		$form->addPassword('password', 'Password:')
			->setRequired('Nezadali jste heslo.');
		$form->addSubmit('login');
		$form->onSuccess[] = [$this, 'loginFormSucceeded'];

		return $form;
	}

	/**
	 * @param UI\Form $form
	 */
	public function loginFormSucceeded(UI\Form $form)
	{
		$values = $form->values;
		try {
			$this->getUser()->login($values->username, $values->password);
			$this->flashMessage('Nyní jste úspěšně přihlášen.', FLASH_SUCCESS);
			$this->restoreRequest($this->backlink);
			//$this->redirect('dashboard:default');
		} catch (Nette\Security\AuthenticationException $e) {
			$this->flashMessage($e->getMessage(), FLASH_WARNING);
			$this->redirect('Sign:in');
		}
	}

	/**
	 *
	 */
	public function actionOut()
	{
		$this->user->logout(true);
		$this->flashMessage('Odhlášení proběhlo v pořádku.', FLASH_SUCCESS);
		$this->redirect('Sign:in');
	}
}