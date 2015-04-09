<?php

namespace App\AdminModule\Presenters;

use App\WebModule\Model\Visitors;
use Nette,
	App\AdminModule\Model,
	Nette\Application\UI;
use Tracy\Debugger;

/**
 * Class HomepagePresenter
 * @package App\AdminModule\Presenters
 */
final class DashboardPresenter extends BasePresenter
{
	/**
	 * @var Model\BranchManager
	 */
	private $branchManager;

	/**
	 * @var
	 */
	private $targetPage;
	/**
	 * @var
	 */
	private $targetParam;

	/**
	 * @var Visitors
	 */
	private $visitors;

	/**
	 * @param Model\UserManager $userManager
	 * @param Nette\Database\Context $database
	 * @param Model\BranchManager $branchManager
	 * @param Visitors $visitors
	 */
	function __construct(Model\UserManager $userManager, Nette\Database\Context $database, Model\BranchManager $branchManager, Visitors $visitors)
	{
		parent::__construct($userManager, $database, $branchManager);
		$this->branchManager = $branchManager;
		$this->visitors = $visitors;
	}


	/**
	 * @param $show
	 */
	public function renderDefault($show)
	{
		$this->template->branch = $this->branchManager->getCurrent();

		switch ($this->branchManager->getCurrentId()) {
			case 1:
				$section = 'Homepage';
				break;
			case 2:
				$section = 'Valmez';
				break;
			case 3:
				$section = 'Roznov';
				break;
			case 4:
				$section = 'Bowling';
				break;
		}

		$filter = $this->visitors->filter($show);
		$visits = $this->visitors->from($section, $filter);
		$this->template->branchVisits = count($visits);

		$this->template->filter = $this->visitors->getFilter();
	}


	/**
	 * @param $target
	 * @param $targetPage
	 * @param $targetAction
	 * @param $targetParam
	 */
	public function renderChangeBranch($target, $targetPage, $targetAction, $targetParam)
	{
		$targetBranch = $this->branchManager->get($target);
		$this->template->switchToBranchName = $targetBranch['name'];
		$this->template->switchToBranchId = $target;

		$this->targetPage = $targetPage . ":" . $targetAction;
		$this->targetParam = $targetParam;
	}

	/**
	 *
	 */
	public function handleGoBack()
	{
		$this->restoreRequest($this->backlink);
	}


	/**
	 * @param $newBranchID
	 */
	public function handleSwitchBranch($newBranchID)
	{
		$this->branchManager->setNew($newBranchID);
		$this->flashMessage('Nyní upravujete sekci ' . $this->branchManager->getCurrentName(), FLASH_INFO);
		$this->redirect("Dashboard:default");
	}

}
