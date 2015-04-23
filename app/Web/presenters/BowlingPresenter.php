<?php
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 3. 2. 2015
 * Time: 19:45
 */

namespace App\WebModule\Presenters;

use App\AdminModule\Model\BowlingPriceManager;
use App\AdminModule\Model\IndividualManager;
use App\AdminModule\Model\OpenTimeManager;
use App\AdminModule\Model\TeamsManager;
use App\AdminModule\Presenters\LeagueTableControl;
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
	 * @var IndividualManager
	 */
	private $individualManager;

	private $teamsManager;


	function __construct(Visitors $visitors, OpenTimeManager $openTimeManager, BowlingPriceManager $bowlingPriceManager, IndividualManager $individualManager, TeamsManager $teamsManager)
	{
		parent::__construct($visitors);
		$this->openTimeManager = $openTimeManager;
		$this->bowlingPriceManager = $bowlingPriceManager;
		$this->individualManager = $individualManager;
		$this->teamsManager = $teamsManager;
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

	/**
	 *
	 */
	public function renderLeague($page)
	{
		$paginator = new Nette\Utils\Paginator;
		$paginator->setItemCount($this->individualManager->total());
		$paginator->setPage($page);
		$paginator->setItemsPerPage(10);

		$this->template->individuals = $this->individualManager->getPage($paginator->getLength(), $paginator->getOffset());
		$this->template->teams = $this->teamsManager->getAll();
		$this->template->paginator = $paginator;

		$this->template->currentFrom = 1 + $paginator->offset;
		$this->template->currentTo = $paginator->itemsPerPage + $paginator->offset;
		$this->template->totalPages = ceil($paginator->itemCount / $paginator->itemsPerPage);

		if ($paginator->isLast()) {
			$this->template->currentTo = $paginator->itemCount;
		}
	}

	public function handleChangePage($newPage) {
		$this->redirect('Bowling:league', $newPage);
	}
}