<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 14:04, 17. 3. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette,
	App\AdminModule\Model;

/**
 * Class TeamPresenter
 * @package App\AdminModule\Presenters
 */
final class TeamPresenter extends BasePresenter
{
	private $teamManager;

	function __construct(Model\UserManager $userManager, Nette\Database\Context $database, Model\BranchManager $branchManager, Model\TeamsManager $teamsManager)
	{
		parent::__construct($userManager, $database, $branchManager);
		$this->teamManager = $teamsManager;
	}


	public function renderList() {
		$this->template->teams = $this->teamManager->getAll();
	}


	public function renderAdd($season)
	{

	}

}