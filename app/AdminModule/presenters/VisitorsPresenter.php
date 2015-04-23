<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 20:26, 23. 4. 2015
 */

namespace App\AdminModule\Presenters;

use App\WebModule\Model\Visitors;
use Nette,
	App\AdminModule\Model;

class VisitorsPresenter extends BasePresenter {

	private $visitors;

	function __construct(Model\UserManager $userManager, Nette\Database\Context $database, Model\BranchManager $branchManager, Visitors $visitors)
	{
		parent::__construct($userManager, $database, $branchManager);
		$this->visitors = $visitors;
	}


	public function renderDefault() {
		$this->template->visitors = $this->visitors->getList();
	}
}