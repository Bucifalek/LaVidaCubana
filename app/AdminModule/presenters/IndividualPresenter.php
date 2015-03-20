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

class IndividualPresenter extends BasePresenter
{
	private $individuaManager;

	function __construct(Model\UserManager $userManager, Nette\Database\Context $database, Model\BranchManager $branchManager, Model\IndividualManager $individualManager)
	{
		parent::__construct($userManager, $database, $branchManager);
		$this->individuaManager = $individualManager;
	}

	public function renderDefault($page)
	{
		$paginator = new Nette\Utils\Paginator;
		$paginator->setItemCount($this->individuaManager->total());
		$paginator->setPage($page);
		$paginator->setItemsPerPage(10);
		$this->template->individuals = $this->individuaManager->getPage($paginator->getLength(), $paginator->getOffset());
		$this->template->paginator = $paginator;

		$this->template->currentFrom = 1 + $paginator->offset;
		$this->template->currentTo = $paginator->itemsPerPage + $paginator->offset;
		$this->template->totalPages = ceil($paginator->itemCount / $paginator->itemsPerPage);
		if ($paginator->isLast()) {
			$this->template->currentTo = $paginator->itemCount;
		}
	}

	public function handleChangePage($pageNum)
	{
		$this->redirect('Individual:default', $pageNum);
	}
}