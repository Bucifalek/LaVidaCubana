<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 22:39, 10. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Model;

use Nette;

class ModulesManager extends Nette\Object
{

	/** @var Nette\Database\Context @inject */
	private $database;

	private $moduleRow;

	function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

	/**
	 * Return JSON of 'options' collum of module
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

	public function getAll()
	{
		$result = [];
		$webContent = $this->database->table('content')->fetchAll();
		foreach ($webContent as $row) { // Foreach used modules
			$moduleOptions = $this->getModuleOptions($row->module);
			$moduleActions = array();
			foreach ($moduleOptions->actions as $name => $action) {
				$moduleActions[$name] = $this->moduleRow->manage_presenter . ":" . $action;
			}
			$result[$this->moduleRow->name . "|" . $moduleOptions->icon] = $moduleActions;
		}
		return $result;
	}
}