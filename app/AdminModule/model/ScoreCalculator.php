<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 22:04, 14. 4. 2015
 */

namespace App\AdminModule\Model;

use Nette;

/**
 * Class ScoreCalculator
 * @package App\AdminModule\Model
 */
class ScoreCalculator extends Nette\Object
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
	 * @param $teamId
	 */
	public function forTeam($teamId)
	{

	}

	/**
	 * @param $playerId
	 */
	public function forPlayer($playerId)
	{

	}
}