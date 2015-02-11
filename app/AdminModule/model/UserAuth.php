<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 20:59, 5. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Model;

use Nette;
use Nette\Security as NS;

class userAuth extends Nette\Object implements NS\IAuthenticator
{

    public $database;

    function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    public function authenticate(array $credentials)
    {
        list($username, $password) = $credentials;
        $row = $this->database->table('admin_users')->where('user', $username)->fetch();

        if (!$row || !NS\Passwords::verify($password, $row->password)) {
            throw new NS\AuthenticationException('Nesprávné jméno nebo heslo.');
        }

        if ($row->banned) {
            throw new NS\AuthenticationException('Tento účet je zablokován.');
        }

        return new NS\Identity($row->id, $row->role, [
                'user' => $row->user,
                'firstname' => $row->real_firstname,
                'lastname' => $row->real_lastname,
                'avatar' => $row->avatar,
                'email' => $row->email
            ]);
    }
}