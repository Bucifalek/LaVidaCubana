<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 12:15, 20. 3. 2015
 */

namespace App\AdminModule\Model;

use Nette;

/**
 * Class IndividualManager
 * @package App\AdminModule\Model
 */
class IndividualManager extends Nette\Object
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
	 * @return int
	 */
	public function total()
	{
		return $this->database->table(DatabaseStructure::BOWLING_PLAYERS)->count();
	}

	/**
	 * @param $limit
	 * @param $offset
	 * @return array
	 */
	public function getPage($limit, $offset)
	{
		$teams = [];
		foreach ($this->database->table(DatabaseStructure::BOWLING_TEAMS)->select('id, team_name')->fetchAll() as $team) {
			$teams[$team->id] = $team->team_name;
		}

		$individualsFinal = [];
		$individuals = $this->database->table(DatabaseStructure::BOWLING_PLAYERS)->limit($limit, $offset)->fetchAll();
		foreach ($individuals as $person) {
			$individualsFinal[] = [
				'name' => $person->name,
				'team' => $person->team,
				'team_name' => $teams[$person->team],
				'score' => $person->score,
				'score_avg' => $person->score_avg,
				'index' => $person->index,
				'matches' => $person->matches,
				'games' => $person->games
			];
		}

		return $individualsFinal;
	}
}