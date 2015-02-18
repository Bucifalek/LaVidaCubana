<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 20:45, 16. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Model;

use Latte\Helpers;
use Nette;
use Tracy\Debugger;

/**
 * Class menuManager
 * @package App\AdminModule\Model
 */
class menuManager extends Nette\Object
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
	 * @param $branchId
	 * @return array
	 */
	public function getMenusFromBranch($branchId)
	{
		return $this->database->table('menu')->where('branch_id', $branchId)->fetchAll();
	}

	/**
	 * @param $menuId
	 * @return array|Nette\Database\Table\IRow[]
	 */
	private function getMenuDetails($menuId)
	{
		return $this->database->table('menu_structure')->where('menu_id', $menuId)->fetchAll();
	}


	/**
	 * @param $id
	 * @return array
	 */
	public function getMenu($id)
	{
		$structured = [];
		foreach ($this->getMenuDetails($id) as $menu) { // Foreach all menu for current branch
			foreach ($this->getMenuDetails($menu->id) as $item) {
				if ($item->level == 0 AND $item->parent_menu_id == '') { // Simple link
					$structured[$item->id] = [
						'name' => $item->name,
						'target' => $item->target,
						'target_data' => $item->target_data,
					];
				} else if ($item->level != 0 AND $item->parent_menu_id == null) { // Dropdown head
					$structured[$item->id] = [
						'name' => $item->name,
						'target' => $item->target,
						'target_data' => $item->target_data,
						'items' => []
					];
				} else { // Dropdown item
					$structured[$item->parent_menu_id]['items'][$item->id] = [
						'name' => $item->name,
						'target' => $item->target,
						'target_data' => $item->target_data,
					];
				}
			}
		}

		//Debugger::barDump($structured);

		return $structured;
	}
}