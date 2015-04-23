<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 12:15, 20. 3. 2015
 */

namespace App\AdminModule\Model;

use Nette;
use Tracy\Debugger;

/**
 * Class IndividualManager
 * @package App\AdminModule\Model
 */
final class IndividualManager extends Nette\Object
{

	/**
	 * @var Nette\Database\Context
	 */
	private $database;

	/**
	 * @var
	 */
	private $find;

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
		if (is_array($this->find)) {
			return $this->database->table(DatabaseStructure::BOWLING_PLAYERS)->where($this->find[0] . ' LIKE ?', '%' . $this->find[1] . '%')->count();
		}

		return $this->database->table(DatabaseStructure::BOWLING_PLAYERS)->count();
	}

	/**
	 * @param $coll
	 * @param $value
	 * @return array|bool
	 */
	public function search($coll, $value)
	{
		return $this->find = (!empty($coll) AND !empty($value)) ? [$coll, $value] : false;
	}

	/**
	 * @param $limit
	 * @param $offset
	 * @return array
	 */
	public function getPage($limit, $offset)
	{
		$teams = [];

		foreach ($this->database->table(DatabaseStructure::BOWLING_TEAMS)->select('id, name')->fetchAll() as $team) {
			$teams[$team->id] = $team->name;
		}

		$individualsFinal = [];
		if ($this->find) {
			$individuals = $this->database->table(DatabaseStructure::BOWLING_PLAYERS)->where($this->find[0] . ' LIKE ?', '%' . $this->find[1] . '%')->order('score DESC')->limit($limit, $offset)->fetchAll();
		} else {
			$individuals = $this->database->table(DatabaseStructure::BOWLING_PLAYERS)->limit($limit, $offset)->order('score DESC')->fetchAll();
		}
		$key = (!$offset) ? 1 : $offset + 1;
		foreach ($individuals as $person) {
			$individualsFinal[$key] = [
				'id'        => $person->id,
				'name'      => $person->name,
				'team'      => $person->team,
				'team_name' => (isset($teams[$person->team])) ? $teams[$person->team] : 'Žádný tým',
				'score'     => $person->score,
				'score_avg' => $person->score_avg,
				'index'     => $person->index,
				'matches'   => $person->matches,
				'games'     => $person->games
			];
			$key++;
		}

		return $individualsFinal;
	}

	/**
	 * @param $id
	 * @return array|Nette\Database\Table\IRow[]
	 */
	public function fromTeam($id)
	{
		return $this->database->table(DatabaseStructure::BOWLING_PLAYERS)->where('team', $id)->order('score DESC')->fetchAll();
	}

	/**
	 * @param $data
	 * @return bool|int|Nette\Database\Table\IRow
	 */
	public function add($data)
	{
		return $this->database->table(DatabaseStructure::BOWLING_PLAYERS)->insert($data);
	}

	/**
	 * @param $id
	 * @return int
	 */
	public function delete($id)
	{
		return $this->database->table(DatabaseStructure::BOWLING_PLAYERS)->where('id', $id)->delete();
	}

	/**
	 * @param $id
	 * @return bool|mixed|Nette\Database\Table\IRow
	 */
	public function get($id)
	{
		return $this->database->table(DatabaseStructure::BOWLING_PLAYERS)->where('id', $id)->fetch();
	}

	/**
	 * @param $id
	 * @param $data
	 * @return int
	 */
	public function update($id, $data)
	{
		return $this->database->table(DatabaseStructure::BOWLING_PLAYERS)->where('id', $id)->update($data);
	}

	/**
	 * @return array
	 */
	public function noTeam()
	{
		return $this->database->table(DatabaseStructure::BOWLING_PLAYERS)->where('team', '0')->fetchAll();
	}

	/**
	 * @param $teamId
	 * @return int
	 */
	public function dropMembersFromTeam($teamId)
	{
		return $this->database->table(DatabaseStructure::BOWLING_PLAYERS)->where('team', $teamId)->update(['team' => 0]);
	}
}