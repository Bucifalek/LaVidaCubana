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
 * Class IndividualPresenter
 * @package App\AdminModule\Presenters
 */
class IndividualPresenter extends BasePresenter
{
	/**
	 * @var Model\IndividualManager
	 */
	private $individualManager;
	/**
	 * @var Model\TeamsManager
	 */
	private $teamsManager;

	/**
	 * @var Model\BranchManager
	 */
	private $branchManager;

	/**
	 * @param Model\UserManager $userManager
	 * @param Nette\Database\Context $database
	 * @param Model\BranchManager $branchManager
	 * @param Model\IndividualManager $individualManager
	 * @param Model\TeamsManager $teamsManager
	 */
	function __construct(Model\UserManager $userManager, Nette\Database\Context $database, Model\BranchManager $branchManager, Model\IndividualManager $individualManager, Model\TeamsManager $teamsManager)
	{
		parent::__construct($userManager, $database, $branchManager);
		$this->individualManager = $individualManager;
		$this->teamsManager = $teamsManager;
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
		$paginator->setItemCount($this->individualManager->total());
		$paginator->setPage($page);
		$paginator->setItemsPerPage(10);

		$this->template->individuals = $this->individualManager->getPage($paginator->getLength(), $paginator->getOffset());
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
	public function renderEdit($id)
	{
		$individual = $this->individualManager->get($id);

		if (!$individual) {
			$this->flashMessage('Spatne ID', FLASH_FAILED);
			$this->redirect('Individual:default');
		}

		$this->template->name = $individual->name;
	}

	/**
	 *
	 */
	public function renderAdd()
	{
		if (!$this->teamsManager->getAll()) {
			$this->flashMessage('Pro přidání hráče musíte nejprve vytvořit tým.', FLASH_WARNING);
			$this->redirect('Team:add');
		}
	}


	/**
	 * @return Nette\Forms\Form
	 */
	public function createComponentAddIndividualForm()
	{
		$teamOptions = [];
		$teamOptions[0] = 'Žádný tým';
		foreach ($this->teamsManager->getAll() as $team) {
			$teamOptions[$team->id] = $team->name;
		}

		$form = new Nette\Application\UI\Form;
		$form->addText('name');
		$form->addSelect('team', null, $teamOptions);
		$form->addSubmit('addUser', 'Přidat');
		$form->onSuccess[] = [$this, 'addIndividualFormSucceeded'];

		return $form;
	}

	/**
	 * @param Nette\Application\UI\Form $form
	 */
	public function addIndividualFormSucceeded(Nette\Application\UI\Form $form)
	{
		$values = $form->getValues();
		$this->individualManager->add([
			'name' => $values->name,
			'team' => $values->team,
		]);
		$this->flashMessage('Jednotlivec přidán, nyní ho můžete zařadit do týmu.', FLASH_SUCCESS);
		$this->redirect('Individual:default');
	}

	/**
	 * @return Nette\Application\UI\Form
	 */
	public function createComponentEditIndividualForm()
	{
		$individual = $this->individualManager->get($this->getParameter('id'));

		$teamOptions = [];
		$teamOptions[0] = 'Žádný tým';
		foreach ($this->teamsManager->getAll() as $team) {
			$teamOptions[$team->id] = $team->name;
		}

		$form = new Nette\Application\UI\Form;
		$form->addText('name')->setValue($individual->name);
		$form->addSelect('team', null, $teamOptions)->setDefaultValue($individual->team);
		$form->addSubmit('saveUser');
		$form->onSuccess[] = [$this, 'editIndividualFormSucceeded'];

		return $form;
	}

	/**
	 * @param Nette\Application\UI\Form $form
	 */
	public function editIndividualFormSucceeded(Nette\Application\UI\Form $form)
	{
		$values = $form->getValues();
		$this->individualManager->update($this->getParameter('id'), [
			'name' => $values->name,
			'team' => $values->team,
		]);
		$this->flashMessage('Změny uloženy.', FLASH_SUCCESS);
		$this->redirect('Individual:default');
	}


	/**
	 * @param $id
	 */
	public function handleRemoveMember($id)
	{
		$this->individualManager->delete($id);
		$this->flashMessage('Jednotlivec úspěšně smazán.');
		$this->redirect('Individual:default', $this->getParameter('page'));
	}

	/**
	 * @param $pageNum
	 */
	public function handleChangePage($pageNum)
	{
		$this->redirect('Individual:default', $pageNum);
	}
}