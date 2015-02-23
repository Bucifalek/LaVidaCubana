<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 23:47, 9. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Model;

use Nette;

/**
 * Class WebStructure
 * @package App\AdminModule\Model
 */
class webStructure extends Nette\Object
{
	/**
	 * @var Nette\Database\Context
	 */
	private $database;

	/**
	 * @param Nette\Database\Context $database
	 */
	function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}


	/**
	 * @return array
	 */
	public function get()
	{
		$result = [];
		$allBranches = $this->database->table('structure')->fetchAll();
		foreach ($allBranches as $branch) {
			$subBranches = $this->database->table('content')->where(['parent_branch' => $branch->branch_id])->fetchAll();
			if (!$subBranches) {
				$result[$branch->name] = [];
			} else {
				foreach ($subBranches as $contentRow) {
					$result[$branch->name][] = [
						'title' => $contentRow->title,
						'manager_presenter' => $contentRow->manager_presenter,
						'view_presenter' => $contentRow->view_presenter,
						'action' => $contentRow->action,
						'theme' => $contentRow->theme
					];
				}
			}
		}
		return $result;
	}
}