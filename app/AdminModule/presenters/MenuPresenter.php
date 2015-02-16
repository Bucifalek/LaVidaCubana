<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 10:05, 16. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette,
	App\AdminModule\Model;

/**
 * Class MenuPresenter
 * @package App\AdminModule\Presenters
 */
class MenuPresenter extends BasePresenter
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
	 * @param Model\UserManager $userManager
	 * @param Nette\Database\Context $database
	 * @param Model\BranchManager $branchManager
	 */
	function __construct(Model\UserManager $userManager, Nette\Database\Context $database, Model\BranchManager $branchManager)
	{
		parent::__construct($userManager, $database, $branchManager);
		$this->userManager = $userManager;
		$this->database = $database;
	}

	public function startup()
	{
		parent::startup();
	}

	public function renderAll()
	{
		$this->template->allMenus = [];
	}
}