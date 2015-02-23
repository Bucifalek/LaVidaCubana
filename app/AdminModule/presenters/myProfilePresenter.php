<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 0:08, 11. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette, App\AdminModule\Model;

/**
 * Class MyProfilePresenter
 * @package App\AdminModule\Presenters
 */
final class myProfilePresenter extends BasePresenter
{

	/**
	 * @var Model\UserManager
	 */
	private $userManager;

	/**
	 * @param Model\UserManager $userManager
	 * @param Nette\Database\Context $database
	 */
	function __construct(Model\UserManager $userManager, Nette\Database\Context $database, Model\BranchManager $branchManager)
	{
		parent::__construct($userManager, $database, $branchManager);
		$this->userManager = $userManager;
	}

	/**
	 * @param $user
	 * @param $avatarID
	 */
	public function handleChangeUserPhoto($user, $avatarID)
	{
		$this->userManager->newAvatar($user, $avatarID);
		$this->user->getIdentity()->avatar = $avatarID;
		$this->redirect('MyProfile:default');
	}
}