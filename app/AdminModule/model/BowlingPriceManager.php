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
}