<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 14:06, 17. 3. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette,
	App\AdminModule\Model;
use Tracy\Debugger;

/**
 * Class ResultPresenter
 * @package App\AdminModule\Presenters
 */
class ResultPresenter extends BasePresenter
{

	/**
	 * @var Model\BranchManager
	 */
	private $branchManager;

	/**
	 * @var Model\TeamsManager
	 */
	private $teamsManager;

	/**
	 * @var Model\IndividualManager
	 */
	private $individualManager;

	/**
	 * @param Model\UserManager $userManager
	 * @param Nette\Database\Context $database
	 * @param Model\BranchManager $branchManager
	 * @param Model\TeamsManager $teamsManager
	 * @param Model\IndividualManager $individualManager
	 */
	function __construct(Model\UserManager $userManager, Nette\Database\Context $database, Model\BranchManager $branchManager, Model\TeamsManager $teamsManager, Model\IndividualManager $individualManager)
	{
		parent::__construct($userManager, $database, $branchManager);
		$this->branchManager = $branchManager;
		$this->teamsManager = $teamsManager;
		$this->individualManager = $individualManager;
	}

	/**
	 *
	 */
	public function beforeRender()
	{
		parent::beforeRender();
		$this->requireBranch(4);


		if ($this->getParameter('season') AND $this->getParameter('step', false) == "vybrat-sezonu") {
			$this->redirect('Result:add', ['step' => 'vybrat-tym', 'season' => $this->getParameter('season')]);
		}

	}

	/**
	 * @param $season
	 */
	public function renderDefault($season)
	{
	}

	/**
	 * @param $year
	 */
	public function renderTop($year)
	{

	}

	/**
	 * @param $step
	 */
	public function renderAdd($step)
	{
		$this->template->step = $step;
		if ($step == 'vybrat-tym') {
			$this->template->season = $this->getParameter('season');
			$this->template->teams = $this->teamsManager->getAll();
		} else if ($step == 'vybrat-hrace') {
			$this->template->season = $this->getParameter('season');
			$this->template->team = $this->getParameter('team');
			$this->template->members = $this->individualManager->fromTeam($this->getParameter('team'));
		} else if ($step == 'pridat-vysledky') {
			$this->template->team = $this->teamsManager->get($this->getParameter('team'));
			$this->template->player = $this->individualManager->get($this->getParameter('player'));
			$this->template->season = $this->getParameter('season');
		}
	}


	/**
	 * @param $id
	 * @param $season
	 */
	public function handleSelectTeam($id, $season)
	{
		$this->redirect('Result:add', ['step' => 'vybrat-hrace', 'season' => $season, 'team' => $id]);
	}


	/**
	 * @param $team
	 * @param $player
	 * @param $season
	 */
	public function handleSelectPlayer($team, $player, $season)
	{
		$this->redirect('Result:add', ['step' => 'pridat-vysledky', 'season' => $season, 'team' => $team, 'player' => $player]);
	}

	/**
	 * @param $season
	 */
	public function handleSelectSeason($season)
	{
		$this->redirect('Result:add', ['step' => 'vybrat-tym', 'season' => $season]);
	}
}