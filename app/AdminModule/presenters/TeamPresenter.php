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


    public function renderDefault($page) {

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

    public function addTeamFormSucceeded($form){
        $values=$form->getValues();
    }

}