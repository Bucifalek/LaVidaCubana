<?php

namespace App\AdminModule\Presenters;

use Nette,
	App\AdminModule\Model,
	Nette\Application\UI;

/**
 * Class HomepagePresenter
 * @package App\AdminModule\Presenters
 */
class HomepagePresenter extends BasePresenter
{

	/**
	 *
	 */
	public function beforeRender()
	{
		parent::beforeRender();
		if (!$this->getUser()->isLoggedIn()) {
			$this->redirect('Sign:in');
		}
	}

}