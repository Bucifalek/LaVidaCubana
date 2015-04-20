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

	private $where;

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
		if (is_array($this->where)) {
			return $this->database->table(DatabaseStructure::BOWLING_PLAYERS)->where($this->where[0] . ' LIKE ?', '%' . $this->where[1] . '%')->count();
		} else {
			return $this->database->table(DatabaseStructure::BOWLING_PLAYERS)->count();
		}
	}

	public function search($coll, $value)
	{
		return $this->where = (!empty($coll) AND !empty($value)) ? [$coll, $value] : false;
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
		if ($this->where) {
			$individuals = $this->database->table(DatabaseStructure::BOWLING_PLAYERS)->where($this->where[0] . ' LIKE ?', '%' . $this->where[1] . '%')->limit($limit, $offset)->fetchAll();
		} else {
			$individuals = $this->database->table(DatabaseStructure::BOWLING_PLAYERS)->limit($limit, $offset)->fetchAll();
		}
		foreach ($individuals as $person) {
			$individualsFinal[] = [
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
}