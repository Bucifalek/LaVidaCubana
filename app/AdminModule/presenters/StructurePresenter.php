<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 23:04, 9. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette,
	App\AdminModule\Model,
	Nette\Database;

/**
 * Class StructurePresenter
 * @package App\AdminModule\Presenters
 */
class StructurePresenter extends BasePresenter
{

	/**
	 * @var
	 */
	private $webStructure;

	/**
	 * @param Model\UserManager $userManager
	 * @param Database\Context $database
	 */
	function __construct(Model\UserManager $userManager, Nette\Database\Context $database, Model\BranchManager $branchManager)
	{
		parent::__construct($userManager, $database, $branchManager);
		//$this->webStructure = new Model\webStructure($database);
	}

	/**
	 *
	 */
	public function renderDefault()
	{
		parent::beforeRender();
		//$this->template->webStructure = $this->webStructure->get();
	}

}