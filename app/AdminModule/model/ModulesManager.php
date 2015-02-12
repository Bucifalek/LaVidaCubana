<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 22:39, 10. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Model;

use Nette;

/**
 * Class ModulesManager
 * @package App\AdminModule\Model
 */
class ModulesManager extends Nette\Object
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
	 * @param Nette\Database\Context $database
	 */
	function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}


	/**
	 * @param $id
	 * @return mixed
	 * @throws \Exception
	 */
	private function getModuleOptions($id)
	{
		$this->moduleRow = $this->database->table('modules')->where(['id' => $id])->fetch();
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
		$webContent = $this->database->table('content')->fetchAll();
		foreach ($webContent as $row) { // Foreach used modules
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