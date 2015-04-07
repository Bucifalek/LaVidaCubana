<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 13:58, 21. 3. 2015
 */

namespace App\AdminModule\Model;

use Nette;

class TeamsManager extends Nette\Object
{

	private $database;

	function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

	public function getAll()
	{
		return $this->database->table(DatabaseStructure::BOWLING_TEAMS)->order('score DESC')->fetchAll();
	}

	public function total()
	{
		return $this->database->table(DatabaseStructure::BOWLING_TEAMS)->count();
	}

	public function get($id)
	{
		return $this->database->table(DatabaseStructure::BOWLING_TEAMS)->where(['id' => $id])->fetch();
	}

	public function getPage($limit, $offset)
	{
		return $this->database->table(DatabaseStructure::BOWLING_TEAMS)->limit($limit, $offset)->order('score DESC')->fetchAll();
	}

	public function removeMember($id)
	{
		return $this->database->table(DatabaseStructure::BOWLING_PLAYERS)->where('id', $id)->update(['team' => 0]);
	}
}