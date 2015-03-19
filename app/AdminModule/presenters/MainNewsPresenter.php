<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 8:13, 18. 3. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette,
	App\AdminModule\Model;
use Tracy\Debugger;

class MainNewsPresenter extends BasePresenter
{
	private $branchManager;

	function __construct(Model\UserManager $userManager, Nette\Database\Context $database, Model\BranchManager $branchManager)
	{
		parent::__construct($userManager, $database, $branchManager);
		$this->branchManager = $branchManager;
	}

	public function beforeRender()
	{
		parent::beforeRender();
		if ($this->branchManager->getCurrentId() != 1) {
			// Pri pokusu otevrit sekci ktera nalezi do jineho branche nez je pro tento presenter urceny
			Debugger::barDump('Warning, spatky branch!');
			$this->redirect('Dashboard:changeBranch', [
				'target' => 1,
				'targetPage' => $this->getPresenter()->name,
				'targetAction' => $this->getAction(),
				'targetParam' => $this->getParameter('key'),
			]);
		}
	}

	public function renderEdit($key)
	{
		// TODO
		if ($key == "roznov") {
			$this->template->title = "Rožnov pod Radhoštěm";
		} else if ($key == "valmez") {
			$this->template->title = "Valašské meziříčí";
		} else {
			$this->template->title = ucfirst($key);
		}

	}

}