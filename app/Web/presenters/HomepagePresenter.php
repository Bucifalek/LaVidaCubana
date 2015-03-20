<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 18:23, 4. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\WebModule\Presenters;

use App\AdminModule\Model\MainNewsManager;
use App\AdminModule\Presenters\MainNewsControl;
use Nette,
	Nette\Application\UI;
use Tracy\Debugger;

/**
 * Class HomepagePresenter
 * @package App\WebModule\Presenters
 */
class HomepagePresenter extends BasePresenter
{

	/**
	 * @var MainNewsManager
	 */
	private $mainNewsManager;

	/**
	 * @param MainNewsManager $mainNewsManager
	 */
	function __construct(MainNewsManager $mainNewsManager)
	{
		$this->mainNewsManager = $mainNewsManager;
	}

	/**
	 * @return MainNewsControl
	 */
	public function createComponentMainNewsRoznov()
	{
		$data = $this->mainNewsManager->get('roznov-pod-radhostem');
		$mainNews = new MainNewsControl();
		$mainNews->setTitle($data->title);
		$mainNews->setRedirect($data->redirect);

		return $mainNews;
	}

	/**
	 * @return MainNewsControl
	 */
	public function createComponentMainNewsValmez()
	{
		$data = $this->mainNewsManager->get('valasske-mezirici');
		$mainNews = new MainNewsControl();
		$mainNews->setTitle($data->title);
		$mainNews->setRedirect($data->redirect);

		return $mainNews;
	}

	/**
	 * @return MainNewsControl
	 */
	public function createComponentMainNewsBowling()
	{
		$data = $this->mainNewsManager->get('bowling');
		$mainNews = new MainNewsControl();
		$mainNews->setTitle($data->title);
		$mainNews->setRedirect($data->redirect);

		return $mainNews;
	}
}