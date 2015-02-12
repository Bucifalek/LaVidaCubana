<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 15:33, 11. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Model;

use Nette;

class ContentManager extends Nette\Object
{

	private $database;

	function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

	public function getContent()
	{
		return $this->database->table('content')->fetchAll();
	}

	public function getAllModules()
	{
		$modules = [];
		foreach ($this->database->table('modules')->fetchAll() as $row) {
			$modules[$row->id] = $row;
		}
		return $modules;
	}
}