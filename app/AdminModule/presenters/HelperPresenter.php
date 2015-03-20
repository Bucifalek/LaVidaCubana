<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 22:26, 20. 3. 2015
 */

namespace App\AdminModule\Presenters;

use Nette, 
	App\AdminModule\Model;

class HelperPresenter extends BasePresenter {

	private $mysqlExporter;

	function __construct(Model\UserManager $userManager, Nette\Database\Context $database, Model\BranchManager $branchManager, Model\MysqlExporter $mysqlExporter)
	{
		parent::__construct($userManager, $database, $branchManager);
		$this->mysqlExporter = $mysqlExporter;
	}


	public function renderDatabaseExport() {
		$this->mysqlExporter->export();
		$this->mysqlExporter->save();
		$this->template->savedTo = $this->mysqlExporter->getFilename();
	}
}