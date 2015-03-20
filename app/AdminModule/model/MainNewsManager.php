<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 9:18, 18. 3. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Model;

use Latte\Loaders\FileLoader;
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

	public function deleteOldImage($key) {
		$data =  $this->database->table('main_news')->where('key', $key)->fetch();
		$image = $data->img_uploaded;
		if($image){
			unlink('Files/NewsImages/' . $image);
		}
	}
}