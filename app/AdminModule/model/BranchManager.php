<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 2:36, 11. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Model;

use Nette;
use Tracy\Debugger;

/**
 * Class BranchManager
 * @package App\AdminModule\Model
 */
class BranchManager extends Nette\Object
{
	/**
	 * @var Nette\Database\Context
	 */
	private $database;

	/**
	 * @var
	 */
	private $branches;

	/**
	 * @var Nette\Http\Session|Nette\Http\SessionSection
	 */
	private $currentBranch;

	/**
	 * @var Nette\Http\SessionSection
	 */
	private $session;


	/**
	 * @param Nette\Database\Context $database
	 * @param Nette\Http\Session $session
	 */
	function __construct(Nette\Database\Context $database, Nette\Http\Session $session)
	{

		$this->database = $database;
		$this->session = $session->getSection('currentBranch');
		$this->currentBranch = $this->session->data;
		$this->branches = $this->database->table(DatabaseStructure::BRANCHES)->fetchAll();

		if (!$this->currentBranch) {
			$this->selectDefault();
		}
	}

	/**
	 * @return array
	 */
	public function selectDefault()
	{
		return $this->session->data = $this->currentBranch = $this->getDefault();
	}

	/**
	 * @return array
	 */
	public function getDefault()
	{
		$branch = reset($this->branches);

		return [
			'id'   => $branch['id'],
			'name' => $branch['name'],
			'url'  => $branch['url'],
		];
	}

	/**
	 * @return array|mixed
	 */
	public function getCurrent()
	{
		return $this->currentBranch;
	}

	/**
	 * @return mixed
	 */
	public function getCurrentName()
	{
		return $this->currentBranch['name'];
	}

	/**
	 * @return mixed
	 */
	public function getCurrentId()
	{
		return $this->currentBranch['id'];
	}

	/**
	 * @return mixed
	 */
	public function getAll()
	{
		return $this->branches;
	}

	public function get($id) {
		$this->branches[$id];
	}

	/**
	 * @param $id
	 */
	public function setNew($id)
	{
		$this->session->data = $this->currentBranch = [
			'id'   => $id,
			'name' => $this->branches[$id]['name'],
			'url'  => $this->branches[$id]['url'],
		];
	}


}
