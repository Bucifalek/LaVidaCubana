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
			$this->userManager->updateActiveTime($this->getUser());
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
		 * Use only glyphicons icons in menu
		 */

		$menu = new MenuControl;
		switch ($this->branchManager->getCurrentId()) {
			/* Branch: Uvodni stranka */
			case 1:
				$menu->addSection('Aktuálně',
					[
						'Valašské meziříčí|coffe_cup' => 'MainNews:edit, valasske-mezirici',
						'Rožnov pod Radhoštěm|coffe_cup' => 'MainNews:edit, roznov-pod-radhostem',
						'Bowling|bowling' => 'MainNews:edit, bowling',
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
				$menu->addSection('testovaci', [
					'test' => 'Team:add',
				]);
				$menu->addSection('Bowlingová liga',
					[
						'Týmy|star' => [
							'Přidat tým|pushpin' => 'Team:add',
							'Tabulka týmů|log_book' => 'Team:list',
						],
						'Jednotlivci|nameplate' => [
							'Přidat jednotlivce|user_add' => 'Individual:add',
							'Seznam jednotlivců|log_book' => 'Individual:default',
						],
						'Aktuálně|warning_sign' => [
							'Přidat|pushpin' => 'News:add',
							'Historie aktualit|history' => 'News:history',
						],
						'Další informace|sampler' => [
							'Otevírací doba|clock' => 'Info:openTime',
							'Ceník bowlingu|coins' => 'Info:bowlingPrice',
							'Pro členy ligy|bowling' => 'Info:forMembers',
						],
					]);
				$menu->addSection('Rozpis ligy',
					[
						'Rozpis 2014|calendar' => [
							'Jarní část|flower' => [
								'Rozpis|edit' => 'League:draft, 2014, jaro',
								'Jednotlivá kola|inbox' => 'League:rounds, 2014, jaro',
								'Přidat kolo|pushpin' => 'League:add, 2014, jaro',
							],
							'Podzimní část|leaf' => [
								'Rozpis|edit' => 'League:draft, 2014, podzim',
								'Jednotlivá kola|inbox' => 'League:rounds, 2014, podzim',
								'Přidat kolo|pushpin' => 'League:add, 2014, podzim',
							],
							'Zimní část|snowflake' => [
								'Rozpis|edit' => 'League:draft, 2014, zima',
								'Jednotlivá kola|inbox' => 'League:rounds, 2014, zima',
								'Přidat kolo|pushpin' => 'League:add, 2014, zima',
							],
							'Play-off|charts' => [
								'Rozpis|edit' => 'League:draft, 2014, playoff',
								'Jednotlivá kola|inbox' => 'League:rounds, 2014, playoff',
								'Přidat tým|pushpin' => 'League:add, 2015, playoff',
								'Přidat kolo|pushpin' => 'Team:addTo, 2014, playoff',
							],
						],
						'Rozpis 2015|calendar' => [
							'Jarní část|flower' => [
								'Rozpis|edit' => 'League:draft, 2015, spring',
								'Jednotlivá kola|inbox' => 'League:rounds, 2015, spring',
								'Přidat kolo|pushpin' => 'League:add, 2015, spring',
							],
							'Podzimní část|leaf' => [
								'Rozpis|edit' => 'League:draft, 2015, fall',
								'Jednotlivá kola|inbox' => 'League:rounds, 2015, fall',
								'Přidat kolo|pushpin' => 'League:add, 2015, fall',
							],
							'Zimní část|snowflake' => [
								'Rozpis|edit' => 'League:draft, 2015, winter',
								'Jednotlivá kola|inbox' => 'League:rounds, 2015, winter',
								'Přidat kolo|pushpin' => 'League:add, 2015, winter',
							],
							'Play-off|charts' => [
								'Rozpis|edit' => 'League:draft, 2015, playoff',
								'Jednotlivá kola|inbox' => 'League:rounds, 2015, playoff',
								'Přidat tým|pushpin' => 'League:add, 2015, playoff',
								'Přidat kolo|pushpin' => 'Team:addTo, 2015, playoff',
							],
						],
						'Přidat další rok|pushpin' => 'League:addYear',
					]);
				$menu->addSection('Výsledky',
					[
						'Výsledky 2014|charts' => [
							'Výsledky zápasů|charts' => [
								'Jarní část|flower' => 'Result:default, spring, 2014',
								'Podzimní část|leaf' => 'Result:default, fall, 2014',
								'Zimní část|snowflake' => 'Result:default, winter, 2014',
							],
							'Top 3|podium' => 'Result:top, 2014'
						],
						'Výsledky 2015|charts' => [
							'Výsledky zápasů|charts' => [
								'Jarní část|flower' => 'Result:default, spring, 2015',
								'Podzimní část|leaf' => 'Result:default, fall, 2015',
								'Zimní část|snowflake' => 'Result:default, winter, 2015',
							],
							'Top 3|podium' => 'Result:top, 2015'
						],
						'Přidat výsledek|new_window' => 'Result:add',
					]);
				break;
		}

		$menu->addSection('Systém', [
			'Správci|group' =>
				[
					'Přidat|user_add' => 'Users:add',
					'Seznam správců|adress_book' => 'Users:list'
				],
			'Kontaktovat podporu|bug' => 'Support:contact',
			'Export databáze|magic' => "Helper:databaseExport",
		]);

		return $menu;
	}
}