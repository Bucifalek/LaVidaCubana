<?php
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 3. 2. 2015
 * Time: 19:45
 */

namespace App\WebModule\Presenters;

use App\AdminModule\Model\BowlingPriceManager;
use App\AdminModule\Model\OpenTimeManager;
use App\WebModule\Model\Visitors;
use Nette;

/**
 * Class BowlingPresenter
 * @package App\WebModule\Presenters
 */
final class BowlingPresenter extends BasePresenter
{

	/**
	 * @var OpenTimeManager
	 */
	private $openTimeManager;

	/**
	 * @var BowlingPriceManager
	 */
	private $bowlingPriceManager;

	/**
	 * @param Visitors $visitors
	 * @param OpenTimeManager $openTimeManager
	 * @param BowlingPriceManager $bowlingPriceManager
	 */
	function __construct(Visitors $visitors, OpenTimeManager $openTimeManager, BowlingPriceManager $bowlingPriceManager)
	{
		parent::__construct($visitors);
		$this->openTimeManager = $openTimeManager;
		$this->bowlingPriceManager = $bowlingPriceManager;
	}

	/**
	 *
	 */
	public function actionPlay()
	{
		$this->template->openTime = $this->openTimeManager->getPairs();
		$this->template->bowlingPrice = $this->bowlingPriceManager->getPairs();
		$this->template->times = $this->bowlingPriceManager->getTimeRanges();
	}
}