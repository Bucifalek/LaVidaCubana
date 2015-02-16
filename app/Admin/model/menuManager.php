<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 20:45, 16. 2. 2015
 * @copyright 2015 Jan Kotrba
 */
 
namespace App\AdminModule\Model;

use Nette;

class menuManager extends Nette\Object {
	
	private $database;

	private $id;

	/**
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}
	
	function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}


}