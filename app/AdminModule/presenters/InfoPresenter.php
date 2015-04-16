<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 22:31, 17. 3. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette,
	App\AdminModule\Model;
use Nette\Application\UI\Form;
use Tracy\Debugger;

/**
 * Class InfoPresenter
 * @package App\AdminModule\Presenters
 */
final class InfoPresenter extends BasePresenter
{
	/**
	 * @var Model\BranchManager
	 */
	private $branchManager;

	/**
	 * @var Model\OpenTimeManager
	 */
	private $openTimeManager;

	/**
	 * @var Model\BowlingPriceManager
	 */
	private $bowlingPriceManager;


	/**
	 * @param Model\UserManager $userManager
	 * @param Nette\Database\Context $database
	 * @param Model\BranchManager $branchManager
	 * @param Model\OpenTimeManager $openTimeManager
	 * @param Model\BowlingPriceManager $bowlingPriceManager
	 */
	function __construct(Model\UserManager $userManager, Nette\Database\Context $database, Model\BranchManager $branchManager, Model\OpenTimeManager $openTimeManager, Model\BowlingPriceManager $bowlingPriceManager)
	{
		parent::__construct($userManager, $database, $branchManager);
		$this->branchManager = $branchManager;
		$this->openTimeManager = $openTimeManager;
		$this->bowlingPriceManager = $bowlingPriceManager;
	}

	/**
	 *
	 */
	public function beforeRender()
	{
		parent::beforeRender();
		$this->requireBranch(4);
	}

	/**
	 *
	 */
	public function renderLeagueMembers()
	{

	}

	/**
	 *
	 */
	public function renderBowlingPrice()
	{
		$this->template->days = $this->bowlingPriceManager->all();
	}

	/**
	 * @return Form
	 */
	public function createComponentBowlingPriceForm()
	{
		$form = new Form();
		$form->addProtection();

		$days = $this->openTimeManager->all();
		foreach ($days as $day) {
			$form->addText('day' . $day->id . '_price_1');
			$form->addText('day' . $day->id . '_price_2');
		}
		$form->addSubmit('save');
		$form->onSuccess[] = [$this, 'bowlingPriceSave'];

		return $form;
	}

	/**
	 * @param Form $form
	 */
	public function bowlingPriceSave(Nette\Application\UI\Form $form)
	{
		$values = $form->getValues();

		for ($dayID = 1; $dayID <= 7; $dayID++) {
			$data = [
				'timezone_1_price' => preg_replace("/[^0-9]/", "", $values->offsetGet('day' . $dayID . '_price_1')),
				'timezone_2_price' => preg_replace("/[^0-9]/", "", $values->offsetGet('day' . $dayID . '_price_2')),
			];
			$this->bowlingPriceManager->updateDay($dayID, $data);
		}

		$this->flashMessage('Změny  uloženy.', FLASH_SUCCESS);
		$this->redirect('Info:bowlingPrice');
	}

	/**
	 *
	 */
	public function renderOpenTime()
	{
		$this->template->days = $this->openTimeManager->all();
	}

	/**
	 *
	 */
	public function createComponentOpenTimeForm()
	{
		$form = new Form();
		$form->addProtection();

		$days = $this->openTimeManager->all();
		foreach ($days as $day) {
			$form->addText('day' . $day->id . '_from');
			$form->addText('day' . $day->id . '_to');
		}
		$form->addSubmit('save');
		$form->onSuccess[] = [$this, 'openTimeSave'];

		return $form;
	}


	/**
	 * @param Nette\Application\UI\Form $form
	 */
	public function openTimeSave(Nette\Application\UI\Form $form)
	{
		$values = $form->getValues();

		for ($dayID = 1; $dayID <= 7; $dayID++) {
			$data = [
				'open'  => preg_replace("/[^0-9:]/", "", $values->offsetGet('day' . $dayID . '_from')),
				'close' => preg_replace("/[^0-9:]/", "", $values->offsetGet('day' . $dayID . '_to')),
			];

			foreach(['open', 'close'] as $key) {
				if($data[$key][2] != ":") {
					$data[$key][3] = $data[$key][2];
					$data[$key][4] = $data[$key][3];
					$data[$key][2] = ':';
				}
			}
			
			$value = str_replace(':', '', $data['open']);
			if ($value > 2400) {
				$data['open'] = '24:00';
			}

			$value = str_replace(':', '', $data['close']);
			if ($value > 2400) {
				$data['close'] = '24:00';
			}

			$this->openTimeManager->updateDay($dayID, $data);
		}

		$this->flashMessage('Změny  uloženy.', FLASH_SUCCESS);
		$this->redirect('Info:openTime');
	}
}