<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 18:23, 4. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\WebModule\Presenters;

use App\AdminModule\Model\MainNewsManager;
use Nette,
	Nette\Application\UI;

class HomepagePresenter extends BasePresenter
{

	private $mainNewsManager;

	function __construct(MainNewsManager $mainNewsManager)
	{
		$this->mainNewsManager = $mainNewsManager;
	}

	public function renderDefault()
	{
		$this->template->akceRoznov = $this->mainNewsManager->getTitle('roznov-pod-radhostem');
		$this->template->akceValmez = $this->mainNewsManager->getTitle('valasske-mezirici');
		$this->template->akceBowling = $this->mainNewsManager->getTitle('bowling');
	}

	public function createComponentWelcome()
	{
		$control = new welcomeControl();
		$control->text = 'Vitejte, todle je moje první funkční komponenta.';

		return $control;
	}

}