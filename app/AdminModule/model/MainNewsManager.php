<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 9:18, 18. 3. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Model;

use Nette;

class MainNewsManager extends Nette\Object
{

	private $database;

	function __construct(Nette\Database\Context $context)
	{
		$this->database = $context;
	}

	public function get($key)
	{
		return $this->database->table('main_news')->where('key', $key)->fetch();
	}

	public function update($key, $data)
	{
		return $this->database->table('main_news')->where('key', $key)->update($data);
	}

	public function getTitle($key)
	{
		$data = $this->database->table('main_news')->where('key', $key)->fetch();
		if (empty($data->title)) {
			return "Tady pro vás nic nemáme.";
		}

		return $data->title;
	}
}