<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 8:13, 18. 3. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette,
	App\AdminModule\Model,
	Nette\Application\UI;
use Tracy\Debugger;

/**
 * Class MainNewsPresenter
 * @package App\AdminModule\Presenters
 */
class MainNewsPresenter extends BasePresenter
{
	/**
	 * @var Model\BranchManager
	 */
	private $branchManager;
	/**
	 * @var Model\MainNewsManager
	 */
	private $mainNewsManager;
	/**
	 * @var
	 */
	private $newsData;

	/**
	 * @param Model\UserManager $userManager
	 * @param Nette\Database\Context $database
	 * @param Model\BranchManager $branchManager
	 * @param Model\MainNewsManager $mainNewsManager
	 */
	function __construct(Model\UserManager $userManager, Nette\Database\Context $database, Model\BranchManager $branchManager, Model\MainNewsManager $mainNewsManager)
	{
		parent::__construct($userManager, $database, $branchManager);
		$this->branchManager = $branchManager;
		$this->mainNewsManager = $mainNewsManager;
	}

	/**
	 *
	 */
	public function beforeRender()
	{
		parent::beforeRender();
		if ($this->branchManager->getCurrentId() != 1) {
			$this->redirect('Dashboard:changeBranch', [
				'target' => 1,
				'targetPage' => $this->getPresenter()->name,
				'targetAction' => $this->getAction(),
				'targetParam' => $this->getParameter('key'),
			]);
		}
	}

	/**
	 * @param $key
	 */
	public function renderEdit($key)
	{
		if (!isset($key)) {
			$this->flashMessage('Neplatna URL', FLASH_WARNING);
			$this->redirect('Dashboard:default');
		}

		if ($key == "roznov-pod-radhostem") {
			$this->template->title = "Rožnov pod Radhoštěm";
		} else if ($key == "valasske-mezirici") {
			$this->template->title = "Valašské meziříčí";
		} else {
			$this->template->title = ucfirst($key);
		}
		$this->newsData = $this->mainNewsManager->get($key);
		$this->template->key = $key;
		$this->template->redirect = $this->newsData->redirect;
		$this->template->img_uploaded = $this->newsData->img_uploaded;
	}

	/**
	 * @return UI\Form
	 */
	public function createComponentEditMainNewsForm()
	{
		$form = new UI\Form;
		$form->addProtection();
		$form->addHidden('key');
		$form->addText('title');
		$form->addTextArea('text');
		if ($this->newsData) {
			$form->values->title = $this->newsData->title;
			$form->values->text = $this->newsData->text;
		}
		$form->addCheckbox('redirect');
		$form->addUpload('img');
		$form->addSubmit('saveChanges');
		$form->onSuccess[] = [$this, 'editMainNewsFormSucceeded'];

		return $form;

	}

	/**
	 * @param UI\Form $form
	 */
	public function editMainNewsFormSucceeded(UI\Form $form)
	{
		$values = $form->getValues();
		$file = $values->img;
		if ($file->isOk()) {
			$name = $file->getSanitizedName();
			$fileExt = explode(".", $name);
			$fileExt = $fileExt[count($fileExt) - 1];
			$newName = Nette\Utils\Random::generate(30) . "." . $fileExt;
			$file->move('Files/NewsImages/' . $newName);
			$values->img_uploaded = $newName;
		}
		if (!$values->redirect) {
			unset($values->text);
		}
		unset($values->img);

		$this->mainNewsManager->update($values->key, $values);
		$this->flashMessage('Ulozeno', FLASH_SUCCESS);
	}

}