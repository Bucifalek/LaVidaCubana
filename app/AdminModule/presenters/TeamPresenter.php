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
 * Class TeamPresenter
 * @package App\AdminModule\Presenters
 */
final class TeamPresenter extends BasePresenter
{
	/**
	 * @var Model\TeamsManager
	 */
	private $teamManager;
	/**
	 * @var Model\IndividualManager
	 */
	private $individualManager;

	/**
	 * @var Model\BranchManager
	 */
	private $branchManager;

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
		$this->teamManager = $teamsManager;
		$this->individualManager = $individualManager;
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
	 * @param $page
	 */
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
	 * @param $id
	 */
	public function handleRemoveTeam($id)
	{
		$this->teamManager->delete($id);
		$this->individualManager->dropMembersFromTeam($id);
		$this->flashMessage('Tým byl odebrán, jeho bývalí členové jsou nyní bez týmu.', FLASH_SUCCESS);
		$this->redirect('Team:default');
	}

	/**
	 * @param $pageNum
	 */
	public function handleChangePage($pageNum)
	{
		$this->redirect('Team:default', $pageNum);
	}

	/**
	 * @param $id
	 */
	public function renderEdit($id)
	{
		try {
			$this->template->team = $this->teamManager->get($id);
		} catch (Model\TeamNowFoundException $e) {
			$this->flashMessage($e->getMessage(), FLASH_WARNING);
			$this->redirect('Team:default');
		}

		$this->template->teamMembers = $this->individualManager->fromTeam($id);
		$this->template->teamId = $id;
		$this->template->noteam = $this->individualManager->noTeam();
	}

	public function handleAssignPlayer($individualId, $teamId)
	{
		$this->teamManager->addToTeam($individualId, $teamId);
		$this->flashMessage('Hráč byl přidán do týmu.', FLASH_SUCCESS);
		$this->redirect('Team:edit', $this->getParameter('id'));
	}


	/**
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentRenameTeamForm()
	{
		$form = new Nette\Application\UI\Form;
		$form->addProtection();
		$form->addText('name');
		$form->addSubmit('save');
		$form->onSubmit[] = callback($this, 'renameTeamFormSucceeded');

		return $form;
	}


	/**
	 * @param Nette\Application\UI\Form $form
	 */
	public function renameTeamFormSucceeded(Nette\Application\UI\Form $form)
	{
		$values = $form->getValues();
		try {
			$this->teamManager->rename($this->getPresenter()->getParameter('id'), $values->name);
			$this->flashMessage('Změny uloženy', FLASH_SUCCESS);
		} catch (Model\TeamNowFoundException $e) {
			$this->flashMessage($e->getMessage(), FLASH_WARNING);
			$this->redirect('Team:edit', $this->getPresenter()->getParameter('id'));
		}
	}


	/**
	 * @param $memberId
	 * @param $teamId
	 */
	public function handleDeleteTeamMember($memberId, $teamId)
	{
		$this->teamManager->removeMember($memberId);
		$this->flashMessage('Hráč byl odebrán z týmu.', FLASH_SUCCESS);
		$this->redirect('Team:edit', $teamId);
	}


	/**
	 * @return Nette\Forms\Form
	 */
	public function createComponentAddTeamForm()
	{
		$form = new Nette\Application\UI\Form;
		$form->addProtection();
		$form->addText('teamName')->setRequired();
		$form->addSubmit('addTeam', 'Přidat hráče');
		$form->onSuccess[] = callback($this, 'addTeamFormSucceeded');

		return $form;
	}

	/**
	 * @param Nette\Application\UI\Form $form
	 */
	public function addTeamFormSucceeded(Nette\Application\UI\Form $form)
	{
		$values = $form->getValues();
		try {
			$this->teamManager->add($values['teamName']);
		} catch (Model\AlreadyExistsException $e) {
			$this->flashMessage($e->getMessage(), FLASH_WARNING);
			$this->redirect('Team:default');
		}
		$this->flashMessage('Tým byl přídán.', FLASH_SUCCESS);
		$this->redirect('Team:default');
	}

}