<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 23:59, 5. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Model;

use Nette;
use Nette\Security as NS;

class UserManager extends Nette\Object
{

    /** @var Nette\Database\Context @inject */
    private $database;

    function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    public function isUserBanned(NS\User $user)
    {
        $row = $this->database->table('admin_users')->where('id', $user->getId())->fetch();
        if ($row->banned) {
            throw new NS\AuthenticationException('Váš účet byl právě zablokován!');
        }
    }

    public function add($details)
    {
        if (!$this->database->table('admin_users')->insert($details)) {
            throw new \Exception('Nepodařilo se uložit do databáze');
        }
    }

    public function ban($id)
    {
        if (!$this->database->table('admin_users')->where('id', $id)->update(['banned' => 1])) {
            throw new \Exception('Nepodařilo se zablokovat správce');
        }
    }

    public function unBan($id)
    {
        if (!$this->database->table('admin_users')->where('id', $id)->update(['banned' => 0])) {
            throw new \Exception('Nepodařilo se odblokovat správce');
        }
    }

    public function newPassword($userID, $plain, $pass)
    {
        if (!$this->database->table('admin_users')->where('id', $userID)->update(
            ['password' => $pass, 'password_pure' => $plain])
        ) {
            throw new \Exception('Nepodařilo se změnit heslo.');
        }
    }

    public function delete($id)
    {
        if (!$this->database->table('admin_users')->where('id', $id)->delete()) {
            throw new \Exception('Nepodařilo se smazat uživatele.');
        }
    }

    public function getDetails($id)
    {
        $data = $this->database->table('admin_users')->where('id', $id)->fetch();
        if (!$data) {
            throw new \Exception('Nelze ziskat informace z databaze');
        } else {
            return $data;
        }
    }

    public function update($id, $data)
    {
        if (!$this->database->table('admin_users')->where('id', $id)->update($data)) {
            throw new \Exception('Nepodarilo se ulozit zmeny');
        }
    }

    public function newAvatar($user, $id)
    {
        $this->database->table('admin_users')->where('id', $user)->update(['avatar' => $id]);
    }
}