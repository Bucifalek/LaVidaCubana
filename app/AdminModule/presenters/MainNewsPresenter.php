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
final class MainNewsPresenter extends BasePresenter
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
		$this->requireBranch(1);
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
		$data = $this->mainNewsManager->get($key);
		if (!$data) {
			$this->flashMessage('Tato sekce novinek neexistuje!', FLASH_FAILED);
			$this->redirect('Dashboard:default');
		}

		$this->newsData = $data;
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
		if ($this->newsData) {
			$form->addText('title')->setDefaultValue($this->newsData->title);
			$form->addTextArea('text')->setDefaultValue($this->newsData->text);
		} else {
			$form->addText('title');
			$form->addTextArea('text');
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

		if (!$values->redirect) {
			$values->text = '';
			$values->img_uploaded = '0';
		}

		if ($values->img->isOk()) {
			$this->mainNewsManager->deleteOldImage($values->key);
			$values->img_uploaded = $this->mainNewsManager->saveImage($values);
		}

		if (!$values->title) {
			$this->flashMessage('Není vyplněný krátký text aktuality.', FLASH_FAILED);
		} else {
			$this->mainNewsManager->update($values->key, $values);
			if ($values->redirect AND $values->text == "") {
				$this->flashMessage('Nemáte vyplněný dlouhý text aktuality.', FLASH_INFO);
			} else {
				$this->flashMessage('Změny uloženy.', FLASH_SUCCESS);
			}
		}
	}

	public function handleDeleteCurrentImage($key)
	{
		$this->mainNewsManager->deleteOldImage($key);
		$this->flashMessage('Změny uloženy.', FLASH_SUCCESS);
	}

	public function handleClear($key)
	{
		$this->mainNewsManager->clear($key);
		$this->flashMessage('Aktualita vymazána.', FLASH_SUCCESS);
		$this->redirect('MainNews:edit', $key);
	}
}