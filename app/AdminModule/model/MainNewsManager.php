<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 9:18, 18. 3. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Model;

use Latte\Loaders\FileLoader;
use Nette;
use Tracy\Debugger;

/**
 * Class MainNewsManager
 * @package App\AdminModule\Model
 */
class MainNewsManager extends Nette\Object
{

	/**
	 * @var Nette\Database\Context
	 */
	private $database;

	/**
	 * @param Nette\Database\Context $context
	 */
	function __construct(Nette\Database\Context $context)
	{
		$this->database = $context;
		Debugger::barDump($context);
	}


	/**
	 * @param $key
	 * @return bool|mixed|Nette\Database\Table\IRow
	 * @throws \Exception
	 */
	public function get($key)
	{
		$result = $this->database->table(DatabaseStructure::MAIN_NEWS)->where('key', $key)->fetch();
		if (!$result) {
			throw new \Exception('MainNews section #' . $key . ' not found!');
		}

		return $result;
	}

	/**
	 * @param $key
	 * @param $data
	 * @return int
	 */
	public function update($key, $data)
	{
		return $this->database->table(DatabaseStructure::MAIN_NEWS)->where('key', $key)->update($data);
	}

	/**
	 * @param $key
	 */
	public function deleteOldImage($key)
	{
		$data = $this->database->table(DatabaseStructure::MAIN_NEWS)->where('key', $key)->fetch();
		$image = $data->img_uploaded;
		if ($image) {
			unlink('Files/NewsImages/' . $image);
		}
	}
}