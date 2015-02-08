<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 1:40, 8. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette,
    App\AdminModule\Model;

class HostingPresenter extends BasePresenter
{

    /** @var Model\UserManager @inject */
    private $userManager;

    function __construct(Model\UserManager $userManager)
    {
        parent::__construct($userManager);
        $this->userManager = $userManager;
    }

    public function beforeRender()
    {
        parent::beforeRender();
        $totalSpace = disk_total_space('.');
        $freeSpace = disk_free_space('.');
        $percentage = 100 - (100 * $freeSpace / $totalSpace);

        $this->template->totalSpace = $totalSpace;
        $this->template->freeSpace = $freeSpace;
        $this->template->percentage = $percentage;
    }
}