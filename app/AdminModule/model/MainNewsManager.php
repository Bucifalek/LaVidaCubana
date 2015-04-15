<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 9:18, 18. 3. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Model;

use Nette;
use Nette\Utils\FileSystem;

/**
 * Class MainNewsManager
 * @package App\AdminModule\Model
 */
final class MainNewsManager extends Nette\Object
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
	}


	/**
	 * @param $key
	 * @return bool|mixed|Nette\Database\Table\IRow
	 * @throws \Exception
	 */
	public function get($key)
	{
		$result = $this->database->table(DatabaseStructure::MAIN_NEWS)->where('key', $key)->fetch();

		return $result;
	}

	/**
	 * @param $key
	 * @param $data
	 * @return int
	 */
	public function update($key, $data)
	{
		unset($data['img']);

		return $this->database->table(DatabaseStructure::MAIN_NEWS)->where('key', $key)->update($data);
	}

	/**
	 * @param $key
	 */
	public function deleteOldImage($key)
	{
		$data = $this->database->table(DatabaseStructure::MAIN_NEWS)->where('key', $key)->fetch();
		if ($data) {
			FileSystem::delete('Files/NewsImages/' . $data->img_uploaded);
			$this->database->table(DatabaseStructure::MAIN_NEWS)->where('key', $key)->update(['img_uploaded' => '']);
		}
	}

	/**
	 * @param $key
	 * @throws \Exception
	 */
	public function clear($key)
	{
		$data = $this->get($key);

		FileSystem::delete('Files/NewsImages/' . $data->img_uploaded);

		$this->database->table(DatabaseStructure::MAIN_NEWS)->where('key', $key)->update([
			'title'        => null,
			'text'         => null,
			'img_uploaded' => 0,
			'redirect'     => 0,
		]);
	}

	/**
	 * @param $values
	 * @return null|string
	 */
	public function saveImage($values)
	{
		@FileSystem::createDir('Files/NewsImages/');

		$file = $values->img;
		if ($file->isOk()) {
			$name = $file->getSanitizedName();
			$fileExt = explode(".", $name);
			$fileExt = $fileExt[count($fileExt) - 1];
			$newName = Nette\Utils\Random::generate(30) . "." . $fileExt;

			if (!$file->move('Files/NewsImages/' . $newName)) {
				$this->error('Upload main news image failed.', FLASH_WARNING);
			}

			return $newName;
		}

		return null;
	}

}
