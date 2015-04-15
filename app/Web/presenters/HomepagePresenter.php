<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 18:23, 4. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\WebModule\Presenters;

use App\AdminModule\Model\MainNewsManager;
use App\AdminModule\Presenters\MainNewsControl;
use App\WebModule\Model\Visitors;
use Nette,
	Nette\Application\UI;
use Tracy\Debugger;

/**
 * Class HomepagePresenter
 * @package App\WebModule\Presenters
 */
final class HomepagePresenter extends BasePresenter
{

	/**
	 * @var MainNewsManager
	 */
	private $mainNewsManager;

	public function __construct(MainNewsManager $mainNewsManager, Visitors $visitors)
	{
		parent::__construct($visitors);
		$this->mainNewsManager = $mainNewsManager;
	}

	private function getMainNews($key)
	{
		$data = $this->mainNewsManager->get($key);
		$mainNews = new MainNewsControl();
		$mainNews->setTitle($data->title);
		$mainNews->setRedirect($data->redirect);

		return $mainNews;
	}

	/**
	 * @return MainNewsControl
	 */
	public function createComponentMainNewsRoznov()
	{
		return $this->getMainNews('roznov-pod-radhostem');
	}

	/**
	 * @return MainNewsControl
	 */
	public function createComponentMainNewsValmez()
	{
		return $this->getMainNews('valasske-mezirici');
	}

	/**
	 * @return MainNewsControl
	 */
	public function createComponentMainNewsBowling()
	{
		return $this->getMainNews('bowling');
	}
}