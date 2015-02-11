<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 0:08, 11. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette, App\AdminModule\Model;

class MyProfilePresenter extends BasePresenter
{

    private $userManager;

    function __construct(Model\UserManager $userManager, Nette\Database\Context $database)
    {
        parent::__construct($userManager, $database);
        $this->userManager = $userManager;
    }

    public function handleChangeUserPhoto($user, $avatarID)
    {
        $this->userManager->newAvatar($user, $avatarID);
        $this->user->getIdentity()->avatar = $avatarID;
        $this->redirect('MyProfile:default');
    }
}