<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 13:58, 21. 3. 2015
 */

namespace App\AdminModule\Model;

use Nette;

/**
 * Class TeamsManager
 * @package App\AdminModule\Model
 */
class TeamsManager extends Nette\Object
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
	public function getAll()
	{
		return $this->database->table(DatabaseStructure::BOWLING_TEAMS)->order('score DESC')->fetchAll();
	}

	/**
	 * @return int
	 */
	public function total()
	{
		return $this->database->table(DatabaseStructure::BOWLING_TEAMS)->count();
	}

	/**
	 * @param $id
	 * @return bool|mixed|Nette\Database\Table\IRow
	 */
	public function get($id)
	{
		$team = $this->database->table(DatabaseStructure::BOWLING_TEAMS)->where(['id' => $id])->fetch();
		if (!$team) {
			throw new TeamNowFoundException('Tento tým neexistuje!');
		}

		return $team;
	}

	/**
	 * @param $limit
	 * @param $offset
	 * @return array|Nette\Database\Table\IRow[]
	 */
	public function getPage($limit, $offset)
	{
		return $this->database->table(DatabaseStructure::BOWLING_TEAMS)->limit($limit, $offset)->order('score DESC')->fetchAll();
	}

	/**
	 * @param $id
	 * @return int
	 */
	public function removeMember($id)
	{
		return $this->database->table(DatabaseStructure::BOWLING_PLAYERS)->where('id', $id)->update(['team' => 0]);
	}


	/**
	 * @param $name
	 * @return bool|int|Nette\Database\Table\IRow
	 * @throws AlreadyExistsException
	 */
	public function add($name)
	{
		if ($this->database->table(DatabaseStructure::BOWLING_TEAMS)->where('name', $name)->count() > 0) {
			throw new AlreadyExistsException('Tento tým již existuje!');
		}

		return $this->database->table(DatabaseStructure::BOWLING_TEAMS)->insert(['name' => $name]);
	}

	/**
	 * @param $id
	 * @return int
	 */
	public function delete($id)
	{
		return $this->database->table(DatabaseStructure::BOWLING_TEAMS)->where('id', $id)->delete();
	}

	/**
	 * @param $id
	 * @param $newName
	 * @throws TeamNowFoundException
	 */
	public function rename($id, $newName)
	{
		if (!$this->database->table(DatabaseStructure::BOWLING_TEAMS)->where('id', $id)->update(['name' => $newName])) {
			throw new TeamNowFoundException('Nepodařilo se přejmenovat team.');
		}
	}

}

/**
 * Class AlreadyExistsException
 * @package App\AdminModule\Model
 */
class AlreadyExistsException extends \Exception
{
}

/**
 * Class TeamNowFoundException
 * @package App\AdminModule\Model
 */
class TeamNowFoundException extends \Exception
{
}