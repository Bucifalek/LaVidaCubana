<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 20:59, 5. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Model;

use Nette;
use Nette\Security as NS;

/**
 * Class userAuth
 * @package App\AdminModule\Model
 */
class UserAuth extends Nette\Object implements NS\IAuthenticator
{

	/**
	 * @var Nette\Database\Context
	 */
	public $database;

	/**
	 * @param Nette\Database\Context $database
	 */
	function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

	/**
	 * @param array $credentials
	 * @return NS\Identity
	 * @throws NS\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;
		$row = $this->database->table('users')->where('user', $username)->fetch();

		if (!$row || !NS\Passwords::verify($password, $row->password)) {
			throw new NS\AuthenticationException('Nesprávné jméno nebo heslo.');
		}

		if ($row->banned) {
			throw new NS\AuthenticationException('Tento účet je zablokován.');
		}
		$this->database->table('users')->where('id', $row->id)->update(['activetime' => time()]);
		return new NS\Identity($row->id, $row->role, [
			'user' => $row->user,
			'firstname' => $row->real_firstname,
			'lastname' => $row->real_lastname,
			'avatar' => $row->avatar,
			'email' => $row->email
		]);
	}
}