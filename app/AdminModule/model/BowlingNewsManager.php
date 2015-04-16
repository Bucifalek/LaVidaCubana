<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 9:31, 15. 4. 2015
 */

namespace App\AdminModule\Model;

use Nette;

/**
 * Class BowlingNewsManager
 * @package App\AdminModule\Model
 */
class BowlingNewsManager extends Nette\Object
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
	 * @param $data
	 * @return bool|int|Nette\Database\Table\IRow
	 */
	public function save($data)
	{
		return $this->database->table(DatabaseStructure::BOWLING_NEWS)->insert($data);
	}

	/**
	 * @param $id
	 * @return bool|mixed|Nette\Database\Table\IRow
	 */
	public function get($id)
	{
		return $this->database->table(DatabaseStructure::BOWLING_NEWS)->where('id', $id)->fetch();
	}

	/**
	 * @param $id
	 * @param $data
	 * @return mixed
	 */
	public function update($id, $data)
	{
		return $this->database->table(DatabaseStructure::BOWLING_NEWS)->where('id', $id)->update($data);
	}


	/**
	 * @param $limit
	 * @param int $offset
	 * @return array|Nette\Database\Table\IRow[]
	 */
	public function all($limit, $offset = 1)
	{
		return $this->database->table(DatabaseStructure::BOWLING_NEWS)->limit($limit, $offset)->order('timestamp DESC')->fetchAll();
	}

	/**
	 * @return int
	 */
	public function total()
	{
		return $this->database->table(DatabaseStructure::BOWLING_NEWS)->count();
	}

	/**
	 * @param $limit
	 * @param $offset
	 * @return array|Nette\Database\Table\IRow[]
	 */
	public function getPage($limit, $offset)
	{
		return $this->database->table(DatabaseStructure::BOWLING_NEWS)->limit($limit, $offset)->order('timestamp DESC')->fetchAll();
	}

	/**
	 * @return null
	 */
	public function current()
	{
		$result = $this->database->table('hc_news')->order('timestamp DESC')->fetch();

		return (isset($result->text)) ? $result->text : null;
	}

	/**
	 * @return bool|mixed|Nette\Database\Table\IRow
	 */
	public function currentMessage()
	{
		return $this->database->table(DatabaseStructure::BOWLING_NEWS)->order('timestamp DESC')->fetch();
	}


	/**
	 * @param $id
	 * @return int
	 */
	public function remove($id)
	{
		return $this->database->table(DatabaseStructure::BOWLING_NEWS)->where(['id' => $id])->delete();
	}
}