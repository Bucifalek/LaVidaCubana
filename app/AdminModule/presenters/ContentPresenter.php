<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 20:04, 10. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette,
    App\AdminModule\Model,
    Nette\Application\UI;

class ContentPresenter extends BasePresenter
{

    /** @var Nette\Database\Context @inject */
    private $database;

    function __construct(Nette\Database\Context $database, Model\UserManager $userManager)
    {
        parent::__construct($userManager, $database);
        $this->database = $database;
    }


    public function renderAddContent()
    {

    }
}