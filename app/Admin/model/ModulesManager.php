<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 22:39, 10. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Model;

use Nette;
use Tracy\Debugger;

/**
 * Class ModulesManager
 * @package App\AdminModule\Model
 */
class modulesManager extends Nette\Object
{

	/**
	 * @var Nette\Database\Context
	 */
	private $database;

	/**
	 * @var
	 */
	private $moduleRow;

	/**
	 * @var BranchManager
	 */
	private $branchManager;

	/**
	 * @param Nette\Database\Context $database
	 * @param BranchManager $branchManager
	 */
	function __construct(Nette\Database\Context $database, BranchManager $branchManager)
	{
		$this->database = $database;
		$this->branchManager = $branchManager;
	}


	/**
	 * @param $id
	 * @return mixed
	 * @throws \Exception
	 */
	private function getModuleOptions($id)
	{
		$this->moduleRow = $this->database->table('modules')->where('id', $id)->fetch();
		if ($this->moduleRow) {
			return json_decode($this->moduleRow->options);
		} else {
			throw new \Exception('Modul s ID = ' . $id . ' není v tabulce modules!');
		}
	}

	/**
	 * @return array
	 * @throws \Exception
	 */
	public function getAllUsed()
	{
		$result = [];
		$allModules = $this->database->table('content')->where('branch_id', $this->branchManager->getCurrentId())->fetchAll();
		foreach ($allModules as $row) {
			$moduleOptions = $this->getModuleOptions($row->module);
			$moduleActions = [];
			foreach ($moduleOptions->actions as $name => $action) {
				$moduleActions[$name] = $this->moduleRow->manage_presenter . ":" . $action;
			}
			$result[$this->moduleRow->name . "|" . $moduleOptions->icon] = $moduleActions;
		}

		return $result;
	}

	/**
	 * @return array
	 */
	public function getAllModules()
	{
		$modules = [];
		foreach ($this->database->table('modules')->fetchAll() as $row) {
			$modules[$row->id] = $row->name;
		}

		return $modules;
	}

	/**
	 * @return mixed
	 */
	public function getModuleRow()
	{
		return $this->moduleRow;
	}
}