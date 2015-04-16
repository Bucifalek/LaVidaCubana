<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 10:28, 13. 4. 2015
 */

namespace App\AdminModule\Model;

use Nette;
use Tracy\Debugger;

/**
 * Class OpenTimeManager
 * @package App\AdminModule\Model
 */
class OpenTimeManager extends Nette\Object
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
	 * @return array|Nette\Database\Table\IRow[]
	 */
	public function all()
	{
		return $this->database->table(DatabaseStructure::BOWLING_OPENTIME)->fetchAll();
	}

	/**
	 * @param $id
	 * @param $data
	 * @return int
	 */
	public function updateDay($id, $data)
	{
		return $this->database->table(DatabaseStructure::BOWLING_OPENTIME)->where('id', $id)->update($data);
	}

	public function getPairs()
	{
		$openTime = [];
		foreach ($this->all() as $day) {
			if (isset($openTime[$day->open . ' - ' . $day->close])) {
				$openTime[$day->open . ' - ' . $day->close]['to'] = $day->day;
			} else {
				$openTime[$day->open . ' - ' . $day->close]['from'] = $day->day;
			}
		}

		return $openTime;
	}
}