<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 19:24, 14. 4. 2015
 */

namespace App\AdminModule\Model;

use Nette;

/**
 * Class BowlingPriceManager
 * @package App\AdminModule\Model
 */
class BowlingPriceManager extends Nette\Object
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
		return $this->database->table(DatabaseStructure::BOWLING_PRICE)->fetchAll();
	}

	public function updateDay($id, $data)
	{
		return $this->database->table(DatabaseStructure::BOWLING_PRICE)->where('id', $id)->update($data);
	}

	public function getPairs()
	{
		$bowlingPrice = [];

		foreach ($this->all() as $day) {
			$key = $day->timezone_1_price . ';' . $day->timezone_2_price;
			if (!isset($bowlingPrice[$key])) {
				$bowlingPrice[$key]['from'] = $day->key;
			} else {
				$bowlingPrice[$key]['to'] = $day->key;
			}
			$bowlingPrice[$key]['price_1'] = $day->timezone_1_price;
			$bowlingPrice[$key]['price_2'] = $day->timezone_2_price;
		}

		return $bowlingPrice;
	}

	public function getTimeRanges()
	{
		return $this->database->table(DatabaseStructure::BOWLING_PRICE)->select('timezone_1_range, timezone_2_range')->fetch();
	}
}