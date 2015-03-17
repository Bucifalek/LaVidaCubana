<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 15:33, 11. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Model;

use Nette;
use Tracy\Debugger;

/**
 * Class ContentManager
 * @package App\AdminModule\Model
 */
class ContentManager extends Nette\Object
{

	/**
	 *
	 */
	const TABLE_CONTENT = "content";

	/**
	 * @var Nette\Database\Context
	 */
	private $database;

	/** @var BranchManager @inject */
	private $branchManager;

	/**
	 * @param Nette\Database\Context $database
	 */
	function __construct(Nette\Database\Context $database, BranchManager $branchManager)
	{
		$this->database = $database;
		$this->branchManager = $branchManager;
	}

	/**
	 * @param $title
	 * @return bool
	 */
	public function isUnique($title)
	{
		if ($this->database->table(self::TABLE_CONTENT)->where('title', $title)->where('branch_id', $this->branchManager->getCurrentId())->count('*') == 0) {
			return true;
		}

		return false;
	}

	/**
	 * @return array
	 */
	public function getAllModules()
	{
		$modules = [];
		foreach ($this->database->table('modules')->fetchAll() as $row) {
			$modules[$row->id] = $row;
		}

		return $modules;
	}


	/**
	 * @param $branch
	 * @param $values
	 * @return bool|int|Nette\Database\Table\IRow
	 */
	public function addNew($values)
	{
		return $this->database->table('content')->insert([
			'branch_id' => $this->branchManager->getCurrentId(),
			'title' => $values['name'],
			'module' => $values['module']
		]);
	}

	/**
	 * @return array|Nette\Database\Table\IRow[]
	 */
	public function getContent($branch)
	{
		return $this->database->table('content')->where('branch_id', $branch)->fetchAll();
	}

	/**
	 * @param $id
	 * @param $branch
	 * @return int
	 */
	public function delete($id, $branch)
	{
		return $this->database->table('content')->where('branch_id', $branch)->where('id', $id)->delete();
	}
}