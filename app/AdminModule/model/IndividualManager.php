<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 12:15, 20. 3. 2015
 */
 
namespace App\AdminModule\Model;

use Nette;
use Tracy\Debugger;

class IndividualManager extends Nette\Object {

	const PLAYERS_TABLE = 'bowling_players';
	const TEAMS_TABLE = 'bowling_teams';
	private $database;
	
	function __construct(Nette\Database\Context $database) 
	{
		$this->database = $database;
	}

	public function total() {
		return $this->database->table(self::PLAYERS_TABLE)->count();
	}

	public function getPage($limit, $offset) {
		$teams = [];
		foreach($this->database->table(self::TEAMS_TABLE)->select('id, team_name')->fetchAll() as $team) {
			$teams[$team->id] = $team->team_name;
		}

		$individualsFinal = [];
		$individuals = $this->database->table(self::PLAYERS_TABLE)->limit($limit, $offset)->fetchAll();
		foreach($individuals as $person) {
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