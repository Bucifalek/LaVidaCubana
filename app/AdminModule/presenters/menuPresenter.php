<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 10:05, 16. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette,
	App\AdminModule\Model;
use Tracy\Debugger;

/**
 * Class MenuPresenter
 * @package App\AdminModule\Presenters
 */
final class menuPresenter extends BasePresenter
{

	/**
	 * @var
	 */
	private $database;
	/**
	 * @var
	 */
	private $userManager;

	/**
	 * @var Model\menuManager
	 */
	private $menuManager;

	/**
	 * @var Model\BranchManager
	 */
	private $branchManager;

	/**
	 * @var Model\modulesManager
	 */
	private $moduleManager;

	/**
	 * @param Model\UserManager $userManager
	 * @param Nette\Database\Context $database
	 * @param Model\BranchManager $branchManager
	 * @param Model\menuManager $menuManager
	 * @param Model\modulesManager $modulesManager
	 */
	function __construct(Model\UserManager $userManager, Nette\Database\Context $database, Model\BranchManager $branchManager, Model\menuManager $menuManager, Model\modulesManager $modulesManager)
	{
		parent::__construct($userManager, $database, $branchManager);
		$this->userManager = $userManager;
		$this->database = $database;
		$this->menuManager = $menuManager;
		$this->branchManager = $branchManager;
		$this->moduleManager = $modulesManager;
	}

	/**
	 *
	 */
	public function renderAll()
	{
		$this->template->allMenus = $this->menuManager->getMenusFromBranch($this->branchManager->getCurrentId());
	}


	/**
	 * @param $id
	 */
	public function actionEdit($id)
	{
		try {
			$this->template->structuredMenu = $this->menuManager->getMenu($id);
			$this->template->modulesList = $this->moduleManager->getAllModules();
		} catch (\Exception $e){
			$this->flashMessage($e->getMessage(), FLASH_FAILED);
			$this->redirect('Menu:all');
		}

	}


	/**
	 *
	 */
	public function beforeRender()
	{
		parent::beforeRender();

	}
}