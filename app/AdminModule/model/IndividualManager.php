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
		Debugger::barDump($teams);

		$individuals = $this->database->table(self::PLAYERS_TABLE)->limit($limit, $offset)->fetchAll();
		foreach($individuals as $person) {
			$team = $this->database->table(self::TEAMS_TABLE)->select('team_name')->where('id', $person['team'])->fetch();
			Debugger::barDump($team->team_name);
		}

		return $individuals;
	}
}