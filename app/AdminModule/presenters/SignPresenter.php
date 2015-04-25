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
use Tracy\Debugger;

/**
 * Class SignPresenter
 * @package App\AdminModule\Presenters
 */
final class SignPresenter extends BasePresenter
{

	/** @persistent */
	public $backlink;

	/**
	 * @var Model\PasswordRecoveryTokens
	 */
	private $recoveryTokens;

	/**
	 * @var Model\UserManager
	 */
	private $userManager;

	/**
	 * @param Model\UserManager $userManager
	 * @param Nette\Database\Context $database
	 * @param Model\BranchManager $branchManager
	 * @param Model\PasswordRecoveryTokens $recoveryTokens
	 */
	function __construct(Model\UserManager $userManager, Nette\Database\Context $database, Model\BranchManager $branchManager, Model\PasswordRecoveryTokens $recoveryTokens)
	{
		parent::__construct($userManager, $database, $branchManager);
		$this->recoveryTokens = $recoveryTokens;
		$this->userManager = $userManager;
	}


	/**
	 *
	 */
	public function renderIn()
	{
		if ($this->getUser()->isLoggedIn()) {
			$this->redirect('Dashboard:default');
		}
	}

	/**
	 * @param $token
	 */
	public function renderRecovery($token)
	{
		if (!$token) {
			$this->flashMessage('Neplatný pokus o obnovení hesla!', FLASH_FAILED);
			$this->redirect('Sign:forgot');
		}
		try {
			$this->recoveryTokens->isValid($token);
		} catch (\Exception $e) {
			$this->flashMessage($e->getMessage(), FLASH_FAILED);
			$this->redirect('Sign:forgot');
		}

		$newPass = Nette\Utils\Random::generate(30, '0-9a-zA-Z');

		$tokenObj = $this->recoveryTokens->details($token);

		$this->userManager->newPassword($tokenObj['user'], Nette\Security\Passwords::hash($newPass));
		$this->template->newPassowrd = $newPass;
	}


	/**
	 * @return UI\Form
	 */
	public function createComponentForgotDetailsForm()
	{
		$form = new UI\Form();
		$form->addProtection();
		$form->addText('email');
		$form->addSubmit('restore');
		$form->onSuccess[] = [$this, 'startRestore'];

		return $form;
	}


	/**
	 * @param $target
	 * @param $token
	 * @return bool
	 */
	private function sendRecoveryEmail($target, $token)
	{
		try {
			$myMailer = new Model\MyMailer;
			$myMailer->setHtmlBody(
				__DIR__ . '/../templates/EmailTemplates/restorePassword.latte',
				[
					'link' => 'http://dev.lavidacubana.cz/admin/obnoveni-hesla/' . $token,
				]
			)
				->addTo($target)
				->setFrom("upozorneni@kotyslab.cz")
				->setSubject("Obnovení hesla");
			$myMailer->sendEmail();
		} catch (\Exception $e) {
			$this->flashMessage("Odesílání emailu selhalo, zkuste to prosím později.", FLASH_FAILED);

			return false;
		}

		return true;
	}

	/**
	 * @param UI\Form $form
	 * @throws Nette\Application\AbortException
	 */
	public function startRestore(UI\Form $form)
	{
		$values = $form->getValues();
		if (!Nette\Utils\Validators::isEmail($values['email'])) {
			$this->flashMessage('Neplatná emailová adresa.', FLASH_FAILED);
			$this->redirect('Sign:forgot');
		}
		$user = $this->userManager->isAssociated($values['email']);
		if (!$user) {
			$this->flashMessage('Tento email nepatří k žádnému účtu.', FLASH_FAILED);
			$this->redirect('Sign:forgot');
		}


		$token = $this->recoveryTokens->generate($user['id']);

		if ($this->sendRecoveryEmail($values['email'], $token)) {
			$this->recoveryTokens->save();
			$this->flashMessage('Email s odkazem pro obnovení hesla odeslán.', FLASH_SUCCESS);
			$this->redirect('Sign:in');
		}
	}

	/**
	 * @return UI\Form
	 */
	protected function createComponentLoginForm()
	{
		$form = new UI\Form;
		$form->addProtection();
		$form->addText('email', 'Name:')
			->setRequired('Nezadali jste email.');

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
			$this->getUser()->login($values->email, $values->password);
			$this->flashMessage('Nyní jste úspěšně přihlášen.', FLASH_SUCCESS);
			$this->restoreRequest($this->backlink);
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
