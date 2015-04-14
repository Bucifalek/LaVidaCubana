<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 22:31, 17. 3. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette,
	App\AdminModule\Model;
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
	 * @param Model\UserManager $userManager
	 * @param Nette\Database\Context $database
	 * @param Model\BranchManager $branchManager
	 * @param Model\OpenTimeManager $openTimeManager
	 */
	function __construct(Model\UserManager $userManager, Nette\Database\Context $database, Model\BranchManager $branchManager, Model\OpenTimeManager $openTimeManager)
	{
		parent::__construct($userManager, $database, $branchManager);
		$this->branchManager = $branchManager;
		$this->openTimeManager = $openTimeManager;
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
		$form = new Nette\Application\UI\Form();
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
				'open'  => $values->offsetGet('day' . $dayID . '_from'),
				'close' => $values->offsetGet('day' . $dayID . '_to'),
			];


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