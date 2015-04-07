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
	private $individualManager;

	function __construct(Model\UserManager $userManager, Nette\Database\Context $database, Model\BranchManager $branchManager, Model\TeamsManager $teamsManager, Model\IndividualManager $individualManager)
	{
		parent::__construct($userManager, $database, $branchManager);
		$this->teamManager = $teamsManager;
		$this->individualManager = $individualManager;
	}


	public function renderDefault($page)
	{

		$paginator = new Nette\Utils\Paginator;
		$paginator->setItemCount($this->teamManager->total());
		$paginator->setPage($page);
		$paginator->setItemsPerPage(10);

		$this->template->teams = $this->teamManager->getPage($paginator->getLength(), $paginator->getOffset());
		$this->template->paginator = $paginator;

		$this->template->currentFrom = 1 + $paginator->offset;
		$this->template->currentTo = $paginator->itemsPerPage + $paginator->offset;
		$this->template->totalPages = ceil($paginator->itemCount / $paginator->itemsPerPage);

		if ($paginator->isLast()) {
			$this->template->currentTo = $paginator->itemCount;
		}
	}

	/**
	 * @param $pageNum
	 */
	public function handleChangePage($pageNum)
	{
		$this->redirect('Team:default', $pageNum);
	}

	public function renderEdit($id)
	{
		$this->template->team = $this->teamManager->get($id);
		$this->template->teamMembers = $this->individualManager->fromTeam($id);
	}

	public function renderAdd($season)
	{

	}

	/**
	 * @return Nette\Forms\Form
	 */
	public function createComponentAddTeamForm()
	{
		$form = new Nette\Forms\Form;
		$form->addText('name')->setRequired('Nezadali jste jméno.');
		$form->addSubmit('addTeam', 'Přidat');
		$form->onSuccess[] = [$this, 'addTeamFormSucceeded'];

		return $form;
	}

	public function addTeamFormSucceeded($form)
	{
		$values = $form->getValues();
	}

	public function handleDeleteTeamMember($memberId, $teamId)
	{
		$this->teamManager->removeMember($memberId);
		$this->flashMessage('Uživatel byl odebrán z týmu.', FLASH_SUCCESS);
		$this->redirect('Team:edit', $teamId);
	}

	public function createComponentRenameTeam()
	{
		$form = new Nette\Forms\Form;
		$form->addText('name')->setRequired('Nezadali jste jméno.');
		$form->addSubmit('save');
		$form->onSuccess[] = [$this, 'saveTeamFormSucceeded'];

		return $form;
	}

}