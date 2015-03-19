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

// Tracy options
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
	 * @var Model\BranchManager @inject
	 */
	private $branchManager;

	/**
	 * @return mixed
	 */

	/** @persistent */
	public $redirectedToLogin = false;

	public function getBranchManager()
	{
		return $this->branchManager;
	}


	function __construct(Model\UserManager $userManager, Nette\Database\Context $database, Model\BranchManager $branchManager)
	{
		$this->userManager = $userManager;
		$this->database = $database;
		$this->branchManager = $branchManager;
	}

	public function beforeRender()
	{
		if ($this->getUser()->isLoggedIn()) {
			$this->redirectedToLogin = false;
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
			$this->database->table('users')->where('id', $this->getUser()->getId())->update(['activetime' => time()]);
		} else if ($this->redirectedToLogin === false) {
			$this->redirectedToLogin = true;
			$this->redirect('Sign:in', ['backlink' => $this->storeRequest()]);
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
		// This is way, how can neon params can be get
		//$config = new \SystemContainer();
		//$config = $config->parameters;
		//Debugger::barDump($config);
	}

	/**
	 * @param $newBranchID
	 */
	public function handleChangeBranch($newBranchID)
	{
		$this->beforeRender();
		$this->branchManager->setNew($newBranchID);
		$this->flashMessage('Nyní upravujete sekci ' . $this->branchManager->getCurrentName(), FLASH_INFO);
		$this->redirect('Dashboard:default');
	}

	/**
	 * @return menuControl
	 */
	public function createComponentMenu()
	{
		/**
		 * Only glyphicons icons in menu
		 */

		$menu = new MenuControl;
		switch ($this->branchManager->getCurrentId()) {
			/* Branch: Uvodni stranka */
			case 1:
				$menu->addSection('Novinky',
					[
						'Valmez|home' => 'MainNews:edit, valasske-mezirici',
						'Rožnov|home' => 'MainNews:edit, roznov-pod-radhostem',
						'Bowling|home' => 'MainNews:edit, bowling',
					]
				);

				break;
			/* Branch: Kavarna Roznov pod Radhostem */
			case 2:
				break;
			/* Branch: Kavarna Valmez */
			case 3:
				break;
			/* Branch: Bowling */
			case 4:

				$menu->addSection('Bowlingová liga',
					[
						'Týmy|star' => [
							'Přidat tým|pushpin' => 'Team:add',
							'Tabulka týmů|log_book' => 'Team:list',
						],

						'Jednotlivci|nameplate' => [
							'Přidat jednotlivce|user_add' => 'Individual:add',
							'Tabulka jednotlivců|log_book' => 'Individual:list',
						],
						'Aktuality|warning_sign' => [
							'Přidat|pushpin' => 'News:add',
							'Historie aktualit|history' => 'News:history',
						],
						'Další informace|sampler' => [
							'Otevírací doba|clock' => 'Info:openTime',
							'Ceník bowlingu|coins' => 'Info:bowlingPrice',
							'Pro členy ligy|bowling' => 'Info:leagueMembers',
						],
					]);

				$menu->addSection('Rozpis ligy',
					[
						'Rozpis 2014|calendar' => [
							'Jarní část|flower' => [
								'Rozpis|edit' => 'League:draft',
								'Jednotlivá kola|inbox' => 'League:rounds',
								'Přidat kolo|pushpin' => 'League:add',
							],
							'Podzimní část|leaf' => [
								'Rozpis|edit' => 'League:draft',
								'Jednotlivá kola|inbox' => 'League:rounds',
								'Přidat kolo|pushpin' => 'League:add',
							],
							'Zimní část|snowflake' => [
								'Rozpis|edit' => 'League:draft',
								'Jednotlivá kola|inbox' => 'League:rounds',
								'Přidat kolo|pushpin' => 'League:add',
							],
							'Play-off|charts' => [
								'Rozpis|edit' => 'League:draft',
								'Jednotlivá kola|inbox' => 'League:rounds',
								'Přidat tým|pushpin' => 'League:add',
								'Přidat kolo|pushpin' => 'League:add',
							],
						],
						'Rozpis 2015|calendar' => [
							'Jarní část|flower' => [
								'Rozpis|edit' => 'League:draft',
								'Jednotlivá kola|inbox' => 'League:rounds',
								'Přidat kolo|pushpin' => 'League:add',
							],
							'Podzimní část|leaf' => [
								'Rozpis|edit' => 'League:draft',
								'Jednotlivá kola|inbox' => 'League:rounds',
								'Přidat kolo|pushpin' => 'League:add',
							],
							'Zimní část|snowflake' => [
								'Rozpis|edit' => 'League:draft',
								'Jednotlivá kola|inbox' => 'League:rounds',
								'Přidat kolo|pushpin' => 'League:add',
							],
							'Play-off|charts' => [
								'Rozpis|edit' => 'League:draft',
								'Jednotlivá kola|inbox' => 'League:rounds',
								'Přidat tým|pushpin' => 'League:add',
								'Přidat kolo|pushpin' => 'League:add',
							],
						],
						'Přidat další rok|pushpin' => 'League:addYear',

					]);

				$menu->addSection('Výsledky',
					[
						'Výsledky 2014|charts' => [
							'Výsledky zápasů|charts' => [
								'Jarní část|flower' => 'Result:spring, 2014',
								'Podzimní část|leaf' => 'Result:fall, 2014',
								'Zimní část|snowflake' => 'Result:winter, 2014',
							],
							'Top 3|podium' => 'Result:top, 2014'
						],
						'Výsledky 2015|charts' => [
							'Výsledky zápasů|charts' => [
								'Jarní část|flower' => 'Result:spring',
								'Podzimní část|leaf' => 'Result:fall',
								'Zimní část|snowflake' => 'Result:winter',
							],
							'Top 3|podium' => 'Result:top, 2015'
						],
						'Přidat výsledek|new_window' => 'Result:add',
					]);


				break;

		}


		/*
			$allModules = [];
			foreach ($this->modulesManager->getAllUsed() as $moduleName => $moduleActions) {
				$allModules[$moduleName] = $moduleActions;
			}
			$menu->addSection('Použité moduly', $allModules);
		*/

		$menu->addSection('Systém', [
			'Správci|group' =>
				[
					'Přidat|user_add' => 'Users:add',
					'Seznam správců|adress_book' => 'Users:list'
				],
			'Kontaktovat podporu|bug' => 'Support:contact'
		]);

		return $menu;
	}
}
