<?php

namespace App\AdminModule\Presenters;

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
	 * @param $targetPage
	 * @param $targetAction
	 * @param $targetParam
	 */
	public function handleSwitchBranch($newBranchID, $targetPage, $targetAction, $targetParam)
	{
		$this->branchManager->setNew($newBranchID);
		$this->flashMessage('Nyní upravujete sekci ' . $this->branchManager->getCurrentName(), FLASH_INFO);
		$this->redirect(":" . $targetPage . ":" . $targetAction, $targetParam);
	}

}
