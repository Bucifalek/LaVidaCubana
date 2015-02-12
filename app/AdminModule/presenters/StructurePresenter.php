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

class StructurePresenter extends BasePresenter
{

	private $WebStructure;

	function __construct(Model\UserManager $userManager, Nette\Database\Context $database)
	{
		parent::__construct($userManager, $database);
		//$this->webStructure = new Model\webStructure($database);
	}

	public function renderDefault()
	{
		parent::beforeRender();
		//$this->template->webStructure = $this->webStructure->get();
	}

}