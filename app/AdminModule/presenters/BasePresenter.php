<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 20:38, 3. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette,
	App\AdminModule\Model,
	Nette\Security,
	Tracy\Debugger;

Debugger::$maxDepth = 10; // default: 3
Debugger::$maxLen = 500; // default: 150

/**
 * Class BasePresenter
 * @package App\AdminModule\Presenters
 */
class BasePresenter extends Nette\Application\UI\Presenter
{
	/**
	 * @var Nette\Database\Context
	 */
	private $database;

	/**
	 * @var Model\UserManager
	 */
	private $userManager;

	/**
	 * @var Model\ModulesManager
	 */
	private $modulesManager;

	/**
	 * @var Model\BranchManager @inject
	 */
	private $branchManager;

	/**
	 * @return mixed
	 */
	public function getBranchManager()
	{
		return $this->branchManager;
	}


	function __construct(Model\UserManager $userManager, Nette\Database\Context $database, Model\BranchManager $branchManager)
	{
		$this->userManager = $userManager;
		$this->database = $database;
		$this->modulesManager = new Model\ModulesManager($database, $branchManager);
		$this->branchManager = $branchManager;
	}

	protected function startup() {
		parent::startup();
	}

	public function beforeRender()
	{
		if ($this->getUser()->isLoggedIn()) {
			$userData = $this->user->getIdentity()->getData();
			$this->template->firstName = $userData['firstname'];
			$this->template->lastName = $userData['lastname'];
			$this->template->avatar = $userData['avatar'];
			$this->template->email = $userData['email'];
			try {
				$this->userManager->isUserBanned($this->getUser());
			} catch (Security\AuthenticationException $e) {
				$this->user->logout(true);
				$this->flashMessage($e->getMessage(), FLASH_WARNING);
				$this->redirect('Sign:in');
			}
		}
		$this->template->getFlashType = function ($arg) {
			$e = explode("|", $arg);

			return @$e[0];
		};
		$this->template->getFlashIcon = function ($arg) {
			$e = explode("|", $arg);

			return @$e[1];
		};

		if ($this->branchManager->getCurrent() == null) {
			$this->branchManager->selectDefault();
		}

		$this->template->branchList = $this->branchManager->getAll();
		$this->template->currentBranch = $this->branchManager->getCurrent();
		$this->template->branchName = $this->branchManager->getCurrentName();
	}

	/**
	 * @param $newBranchID
	 */
	public function handleChangeBranch($newBranchID)
	{
		$this->beforeRender();
		$this->branchManager->setNew($newBranchID);
		$this->flashMessage('Nyní upravujete sekci ' . $this->branchManager->getCurrentName(), FLASH_INFO);
		$this->redirect($this->getAction());
	}

	/**
	 * @return menuControl
	 */
	public function createComponentMenu()
	{
		/**
		 * Only glyphicons icons in menu
		 */
		$menu = new menuControl;
		// Struktura CMS

		$menu->addSection('Hlavní menu',
			[
				'Menu|list' => [
					'Přidat menu|circle_plus' => 'Menu:add',
					'Všechny nabídky|notes_2' => 'Menu:all',
					'Aktuální struktura' => 'Menu:structure', //TODO add icon
				],
				'Obsah' => [
					'Přidat položku|circle_plus' => 'Content:addContent',
					'Všechny položky|notes_2' => 'Content:allContent',
				],
				'Úložiště|hdd' => [
					'Nahrávání souborů|file_import' => 'Files:upload',
					'Všechny soubory|folder_open' => 'Files:allFiles',
				]
			]);

		$allModules = [];
		foreach ($this->modulesManager->getAllUsed() as $moduleName => $moduleActions) {
			$allModules[$moduleName] = $moduleActions;
		}
		$menu->addSection('Použité moduly', $allModules);

		// Struktura CMS
		$menu->addSection('Systém', [
			'Správci|group' =>
				[
					'Přidat|user_add' => 'Users:add',
					'Seznam správců|adress_book' => 'Users:list'
				],
			'Testy|electricity' =>
				[
					'Emaily' => 'Test:sendEmail'
				],
			'Nahlásit chybu|bug' => 'Report:error'
		]);

		return $menu;
	}
}