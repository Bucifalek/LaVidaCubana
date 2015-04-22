<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 14:04, 17. 3. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette,
	App\AdminModule\Model;
use Tracy\Debugger;

/**
 * Class LeaguePresenter
 * @package App\AdminModule\Presenters
 */
final class LeaguePresenter extends BasePresenter
{

	/**
	 * @var Model\BranchManager
	 */
	private $branchManager;

	/**
	 * @param Model\UserManager $userManager
	 * @param Nette\Database\Context $database
	 * @param Model\BranchManager $branchManager
	 */
	function __construct(Model\UserManager $userManager, Nette\Database\Context $database, Model\BranchManager $branchManager)
	{
		parent::__construct($userManager, $database, $branchManager);
		$this->branchManager = $branchManager;
	}

	/**
	 *
	 */
	public function beforeRender()
	{
		parent::beforeRender();
		$this->requireBranch(4);
	}

	/**
	 * @param $season
	 */
	public function renderDraft($season)
	{

	}

	/**
	 * @param $season
	 */
	public function renderRounds($season)
	{

	}

	/**
	 * @param $season
	 */
	public function renderAddRound($season)
	{

	}

	/**
	 * @param $season
	 */
	public function renderAddTeam($season)
	{

	}
}