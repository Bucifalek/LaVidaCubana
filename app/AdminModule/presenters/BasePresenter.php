<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 20:38, 3. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use App\WebModule\Model\Visitors;
use Nette,
	App\AdminModule\Model,
	Nette\Security;
use Tracy\Debugger;

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
	 * @var Model\BranchManager
	 */
	private $branchManager;

	/**
	 * @return mixed
	 */

	public function getBranchManager()
	{
		return $this->branchManager;
	}

	public function requireBranch($id)
	{
		if ($this->branchManager->getCurrentId() != $id) {
			$this->redirect('Dashboard:changeBranch', [
				'target' => $id,
			]);
		}
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
			$userData = $this->getUser()->getIdentity()->getData();

			$this->template->firstName = $userData['firstname'];
			$this->template->lastName = $userData['lastname'];
			$this->template->avatar = $userData['avatar'];
			$this->template->email = $userData['email'];

			try {
				$this->userManager->isUserBanned($this->getUser());
			} catch (Security\AuthenticationException $e) {
				$this->getUser()->logout(true);
				$this->flashMessage($e->getMessage(), FLASH_WARNING);
				$this->redirect('Sign:in');
			}
			$this->userManager->updateActiveTime($this->getUser());
		} else if (!$this->isLinkCurrent('Sign:*')) {
			if (!$this->isLinkCurrent('Dashboard:default')) {
				$this->flashMessage('Pro vstup musíte být přihlášen', FLASH_WARNING);
			}
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

		$this->template->branchList = $this->branchManager->getAll();
		$this->template->currentBranch = $this->branchManager->getCurrent();
		$this->template->branchName = $this->branchManager->getCurrentName();


		$allowedRoutes = [
			'Admin:Individual',
		];
		$this->template->sId = ($this->getAction() == "default" AND (in_array($this->getName(), $allowedRoutes))) ? "content_wrapper" : "content";
	}

	/**
	 * @param $newBranchID
	 */
	public function handleChangeBranch($newBranchID)
	{
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
		 * Use only glyphicons icons
		 */

		$menu = new MenuControl();
		switch ($this->branchManager->getCurrentId()) {
			/* Branch: Uvodni stranka */
			case 1:
				$menu->addSection('Aktuálně',
					[
						'Rožnov pod Radhoštěm|coffe_cup' => 'MainNews:edit, roznov-pod-radhostem',
						'Valašské meziříčí|coffe_cup'    => 'MainNews:edit, valasske-mezirici',
						'Bowling|bowling'                => 'MainNews:edit, bowling',
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
						'Týmy|star'               => [
							'Přidat tým|pushpin'    => 'Team:add',
							'Tabulka týmů|log_book' => 'Team:default',
						],
						'Jednotlivci|nameplate'   => [
							'Přidat jednotlivce|user_add' => 'Individual:add',
							'Seznam jednotlivců|log_book' => 'Individual:default',
						],
						'Aktuálně|warning_sign'   => [
							'Přidat|pushpin'            => 'News:add',
							'Historie aktualit|history' => 'News:default',
						],
						'Další informace|sampler' => [
							'Otevírací doba|clock'   => 'Info:openTime',
							'Ceník bowlingu|coins'   => 'Info:bowlingPrice',
							'Pro členy ligy|bowling' => 'Info:forMembers',
						],
					]);

				$menu->addSection('Rozpis ligy',
					[
						'Jarní část|flower'    => [
							'Rozpis|edit'           => 'League:draft, leto',
							'Jednotlivá kola|inbox' => 'League:rounds, leto',
							'Přidat kolo|pushpin'   => 'League:addRound, leto',
						],
						'Podzimní část|leaf'   => [
							'Rozpis|edit'           => 'League:draft, podzim',
							'Jednotlivá kola|inbox' => 'League:rounds, podzim',
							'Přidat kolo|pushpin'   => 'League:addRound, podzim',
						],
						'Zimní část|snowflake' => [
							'Rozpis|edit'           => 'League:draft, zima',
							'Jednotlivá kola|inbox' => 'League:rounds, zima',
							'Přidat kolo|pushpin'   => 'League:addRound, zima',
						],
						'Play-off|charts'      => [
							'Rozpis|edit'           => 'League:draft, playoff',
							'Jednotlivá kola|inbox' => 'League:rounds, playoff',
							'Přidat kolo|pushpin'   => 'League:addRound, playoff',
							'Přidat tým|pushpin'    => 'League:addTeam, playoff',
						],
					]);

				$menu->addSection('Výsledky',
					[
						'Výsledky zápasů|charts'     => [
							'Jarní část|flower'    => 'Result:default, jaro',
							'Podzimní část|leaf'   => 'Result:default, podzim',
							'Zimní část|snowflake' => 'Result:default, zima',
							'Play-off|charts'      => 'Result:default, play-off',
						],
						'Top 3|podium'               => 'Top:default',
						'Přidat výsledek|new_window' => 'Result:add',
					]);
				break;
		}

		$menu->addSection('Systém', [
			'Správci|group'           =>
				[
					'Přidat|user_add'            => 'Users:add',
					'Seznam správců|adress_book' => 'Users:default'
				],
			'Kontaktovat podporu|bug' => 'Support:contact',
			'Export databáze|magic'   => "Helper:databaseExport",
		]);

		return $menu;
	}
}
