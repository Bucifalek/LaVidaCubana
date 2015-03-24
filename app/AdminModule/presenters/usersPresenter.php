<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 22:35, 5. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use App\AdminModule\Model,
	Nette\Application\UI,
	Nette\Database\Context,
	Nette\Security\Passwords,
	Utils;

/**
 * Class UsersPresenter
 * @package App\AdminModule\Presenters
 */
final class UsersPresenter extends BasePresenter
{
	/**
	 * @var Context
	 */
	private $database;

	/**
	 * @var Model\UserManager
	 */
	private $userManager;

	/**
	 * @param Context $database
	 * @param Model\UserManager $userManager
	 */
	function __construct(Context $database, Model\UserManager $userManager, Model\BranchManager $branchManager)
	{
		parent::__construct($userManager, $database, $branchManager);
		$this->database = $database;
		$this->userManager = $userManager;
	}


	public function renderList()
	{
		$this->template->currentUsers = $this->userManager->allUsers();
	}

	/**
	 * @param $userID
	 * @throws \Exception
	 */
	public function renderEdit($userID)
	{
		if (!isset($userID)) {
			$this->flashMessage('Neplatna URL', FLASH_INFO);
			$this->redirect('Users:list');
		}
		$this->template->userData = $this->userManager->getDetails($userID);
	}


	/**
	 * @param $id
	 */
	public function handleBanUser($id)
	{
		try {
			$userDetails = $this->userManager->getDetails($id);
			$this->userManager->ban($id);
		} catch (\Exception $e) {
			$this->flashMessage($e->getMessage(), FLASH_WARNING);
			$this->redirect('Users:list');
		}

		if (isset($userDetails)) {
			try {
				$myMailer = new Model\myMailer;
				$myMailer->setHtmlBody(
					__DIR__ . '/../templates/EmailTemplates/banUserEmail.latte',
					[
						'firstname' => $userDetails->real_firstname,
						'lastname' => $userDetails->real_lastname,
						'user' => $userDetails->user,
						'website' => 'La VIDA Cubana',
						'website_url' => 'http://cms.jkotrba.net/admin/'
					]
				)
					->addTo($userDetails->email)
					->setFrom("cms@jkotrba.net")
					->setSubject("Váš účet byl zablokován!");
				$myMailer->sendEmail();
			} catch (\Exception $e) {
				$this->flashMessage($e->getMessage(), FLASH_WARNING);
				$this->redirect('Users:list');
			}
			$this->flashMessage("Uživatel " . $userDetails->user . " byl zablokován a na jeho email " . $userDetails->email . " bylo odesláno oznámení.", FLASH_SUCCESS);
		}
		$this->redirect('Users:list');
	}

	/**
	 * @param $id
	 */
	public function handleUnBanUser($id)
	{
		try {
			$this->userManager->unBan($id);
		} catch (\Exception $e) {
			$this->flashMessage($e->getMessage(), FLASH_WARNING);
		}
		$this->flashMessage("Správce odblokován.", FLASH_SUCCESS);
		$this->redirect('Users:list');
	}


	/**
	 * @param $id
	 */
	public function handleRegenPass($id)
	{
		$strongPassword = Utils\passGenerator::generateStrongPassword();
		try {
			$userDetails = $this->userManager->getDetails($id);
			$this->userManager->newPassword($id, $strongPassword, Passwords::hash($strongPassword));
		} catch (\Exception $e) {
			$this->flashMessage($e->getMessage(), FLASH_WARNING);
			$this->redirect('Users:list');
		}

		if (isset($userDetails)) {
			try {
				$myMailer = new Model\myMailer;
				$myMailer->setHtmlBody(
					__DIR__ . '/../templates/EmailTemplates/passwordChangeEmail.latte',
					[
						'user' => $userDetails->user,
						'website' => 'La VIDA Cubana',
						'website_url' => 'http://cms.jkotrba.net/admin/',
						'newPassword' => $strongPassword
					]
				)
					->addTo($userDetails->email)
					->setFrom("cms@jkotrba.net")
					->setSubject("Vašemu účtu bylo vygenerováno nové heslo");
				$myMailer->sendEmail();
			} catch (\Exception $e) {
				$this->flashMessage($e->getMessage(), FLASH_WARNING);
				$this->redirect('Users:list');
			}
			$this->flashMessage("Nové heslo bylo vygenerováno a na příslušný email bylo odesláno oznámení o změně.", FLASH_SUCCESS);
		}
		$this->redirect('Users:list');
	}


	/**
	 * @param $id
	 */
	public function handleDeleteUser($id)
	{
		try {
			$this->userManager->delete($id);
		} catch (\Exception $e) {
			$this->flashMessage($e->getMessage(), FLASH_WARNING);
			$this->redirect('Users:list');
		}

		$this->flashMessage("Účet byl úspěšně smazán, správce již nemá přístup do systému.", FLASH_SUCCESS);
		$this->redirect('Users:list');
	}


	/**
	 * @return UI\Form
	 */
	public function createComponentUpdateUserForm()
	{
		$form = new UI\Form;
		$form->addHidden('id');
		$form->addText('firstname')->setRequired('Nezadali jste jméno.');
		$form->addText('lastname')->setRequired('Nezadali jste prijmeni');
		$form->addText('email')->setRequired('nezadali jste email');
		$form->addtext('username')->setRequired('nezadlai jste jmeno pro prihlaseni');
		$form->addSubmit('updateUser', 'Uložit změny');
		$form->onSuccess[] = [$this, 'updateUserFormSucceeded'];

		return $form;
	}


	/**
	 * @param UI\Form $form
	 * @param $values
	 */
	public function updateUserFormSucceeded(UI\Form $form, $values)
	{
		try {
			$this->userManager->update($values->id, [
				'real_firstname' => $values->firstname,
				'real_lastname' => $values->lastname,
				'user' => $values->username,
				'email' => $values->email
			]);
		} catch (\Exception $e) {
			$this->flashMessage($e->getMessage(), FLASH_WARNING);
			$this->redirect('Users:list');
		}
		$this->flashMessage('Změny účtu uloženy.', FLASH_INFO);
		$this->redirect('Users:list');
	}


	/**
	 * @return UI\Form
	 */
	public function createComponentAddUserForm()
	{
		$form = new UI\Form;
		$form->addText('firstname')->setRequired('Nezadali jste jméno.');
		$form->addText('lastname')->setRequired('Nezadali jste prijmeni');
		$form->addText('email')->setRequired('nezadali jste email');
		$form->addtext('username')->setRequired('nezadlai jste jmeno pro prihlaseni');
		$form->addSubmit('addUser', 'Přidat');
		$form->onSuccess[] = [$this, 'addUserFormSucceeded'];

		return $form;
	}


	/**
	 * @param UI\Form $form
	 * @param $values
	 */
	public function addUserFormSucceeded(UI\Form $form, $values)
	{
		$strongPassword = Utils\passGenerator::generateStrongPassword();
		try {
			$this->userManager->add([
				'user' => $values->username,
				'password' => Passwords::hash($strongPassword),
				'real_firstname' => $values->firstname,
				'real_lastname' => $values->lastname,
				'email' => $values->email,
				'banned' => '0'
			]);
		} catch (\Exception $e) {
			$this->flashMessage($e->getMessage(), FLASH_WARNING);
		}

		try {
			$myMailer = new Model\MyMailer;
			$myMailer->setHtmlBody(
				__DIR__ . '/../templates/EmailTemplates/newUserEmail.latte',
				[
					'username' => $values->username,
					'firstname' => $values->firstname,
					'lastname' => $values->lastname,
					'password' => $strongPassword,
					'website' => 'La VIDA Cubana',
					'website_url' => 'http://cms.jkotrba.net/admin/'
				]
			)
				->addTo($values->email)
				->setFrom("upozorneni@kotyslab.cz")
				->setSubject("Vytvoření účtu");
			$myMailer->sendEmail();
		} catch (\Exception $e) {
			$this->flashMessage($e->getMessage(), FLASH_WARNING);
			$this->redirect('Users:list');
		}


		$this->flashMessage("Správce přidán do systému, nyní se může snadno přihlásit, heslo je $strongPassword", FLASH_SUCCESS);
		$this->redirect('Users:list');
	}
}