<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 23:59, 5. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Model;

use Nette;
use Nette\Security as NS;

/**
 * Class UserManager
 * @package App\AdminModule\Model
 */
final class UserManager extends Nette\Object
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
	 * @param NS\User $user
	 * @throws NS\AuthenticationException
	 */
	public function isUserBanned(NS\User $user)
	{
		$row = $this->database->table(DatabaseStructure::USERS)->where('id', $user->getId())->fetch();
		if ($row->banned) {
			throw new NS\AuthenticationException('Váš účet byl právě zablokován!');
		}
	}


	/**
	 * @param $id
	 * @param $data
	 * @throws \Exception
	 */
	public function update($id, $data)
	{
		try {
			$this->database->table(DatabaseStructure::USERS)->where('id', $id)->update($data);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}

	/**
	 * @param $userID
	 * @param $pass
	 * @throws \Exception
	 */
	public function newPassword($userID, $pass)
	{
		if (!$this->database->table(DatabaseStructure::USERS)->where('id', $userID)->update(['password' => $pass])) {
			throw new \Exception('Nepodařilo se změnit heslo.');
		}
	}


	/**
	 * @param $id
	 * @return bool|mixed|Nette\Database\Table\IRow
	 * @throws \Exception
	 */
	public function getDetails($id)
	{
		$data = $this->database->table(DatabaseStructure::USERS)->where('id', $id)->fetch();
		if (!$data) {
			throw new \Exception('Nelze ziskat informace z databaze');
		} else {
			return $data;
		}
	}

	/**
	 * @param $details
	 * @throws \Exception
	 */
	public function add($details)
	{
		/*
		$sameEmail = $this->database->table(DatabaseStructure::USERS)->where('email', $details['email'])->count();
		$sameNickName = $this->database->table(DatabaseStructure::USERS)->where('nickname', $details['nickname'])->count();
		if($sameEmail OR $sameNickName) {
			throw new \Exception('titu uzivatele jiz existuji.');
		}*/

		if (!$this->database->table(DatabaseStructure::USERS)->insert($details)) {
			throw new \Exception('Nepodařilo se uložit do databáze');
		}
	}

	/**
	 * @param $id
	 * @throws \Exception
	 */
	public function ban($id)
	{
		if (!$this->database->table(DatabaseStructure::USERS)->where('id', $id)->update(['banned' => 1, 'bantime' => time()])) {
			throw new \Exception('Nepodařilo se zablokovat správce');
		}
	}

	/**
	 * @param $id
	 * @throws \Exception
	 */
	public function unBan($id)
	{
		if (!$this->database->table(DatabaseStructure::USERS)->where('id', $id)->update(['banned' => 0])) {
			throw new \Exception('Nepodařilo se odblokovat správce');
		}
	}

	/**
	 * @param $id
	 * @throws \Exception
	 */
	public function delete($id)
	{
		if (!$this->database->table(DatabaseStructure::USERS)->where('id', $id)->delete()) {
			throw new \Exception('Nepodařilo se smazat uživatele.');
		}
	}

	/**
	 * @param $user
	 * @param $id
	 */
	public function newAvatar($user, $id)
	{
		$this->database->table(DatabaseStructure::USERS)->where('id', $user)->update(['avatar' => $id]);
	}

	/**
	 * @return array|Nette\Database\Table\IRow[]
	 */
	public function allUsers()
	{
		return $this->database->table(DatabaseStructure::USERS)->order('banned ASC,real_firstname ASC')->fetchAll();
	}

	/**
	 * @param $user
	 */
	public function updateActiveTime($user)
	{
		$this->database->table(DatabaseStructure::USERS)->where('id', $user->getId())->update(['activetime' => time()]);
	}

	/**
	 * @param $email
	 * @return int
	 */
	public function isAssociated($email)
	{
		return $this->database->table(DatabaseStructure::USERS)->where('email', $email)->fetch();
	}

}
