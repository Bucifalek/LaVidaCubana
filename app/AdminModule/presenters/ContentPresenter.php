<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 20:04, 10. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette,
	App\AdminModule\Model,
	Nette\Application\UI;

/**
 * Class ContentPresenter
 * @package App\AdminModule\Presenters
 */
class ContentPresenter extends BasePresenter
{
	/**
	 * @var Nette\Database\Context
	 */
	private $database;

	/**
	 * @var Model\ContentManager
	 */
	private $contentManager;
	/**
	 * @var Model\ModulesManager
	 */
	private $modulesManager;

	/**
	 * @var array
	 */
	private $webModules;

	/*** @var Model\BranchManager @inject */
	public $branchManager;



	/**
	 * @param Nette\Database\Context $database
	 * @param Model\UserManager $userManager
	 * @param Model\ModulesManager $modulesManager
	 * @param Model\BranchManager $branchManager
	 */
	function __construct(Nette\Database\Context $database,
						 Model\UserManager $userManager,
						 Model\ModulesManager $modulesManager,
						 Model\BranchManager $branchManager)
	{
		parent::__construct($userManager, $database, $branchManager);
		$this->database = $database;
		$this->contentManager = new Model\ContentManager($database, parent::getBranchManager());
		$this->webModules = $this->contentManager->getAllModules();
		$this->modulesManager = $modulesManager;
		$this->branchManager = $branchManager;
	}

	/**
	 * @return array
	 */
	private function prepareWebContent()
	{
		$webModules = [];
		$content = $this->contentManager->getContent($this->branchManager->getCurrentID());
		$modules = $this->webModules;
		foreach ($content as $row) {
			$webModules[] = [
				'id' => $row->id,
				'title' => $row->title,
				'module' => $modules[$row->module]['name']];
		}

		return $webModules;
	}


	/**
	 * @return array
	 */
	public function renderAllContent()
	{
		return $this->template->webContent = $this->prepareWebContent();
	}

	/**
	 * @return UI\Form
	 */
	public function createComponentAddContentForm()
	{
		$form = new UI\Form;
		$form->addProtection();
		$form->addText('name')->setRequired('Musíte zadat název');
		$form->addSelect('module', null, $this->modulesManager->getAllModules())->setPrompt('Vyberte...')->setRequired();
		$form->onSuccess[] = [$this, 'addContentFormSuccess'];

		return $form;
	}


	/**
	 * @param UI\Form $form
	 */
	public function addContentFormSuccess(UI\Form $form, $values)
	{
		if ($this->contentManager->isUnique($values->name)) {
			$this->contentManager->addNew($form->getValues());
			$this->flashMessage('Položka úspěšně přidána', FLASH_SUCCESS);
			$this->redirect("Content:addContent");
		} else {
			$this->flashMessage('Položka s tímto jménem již existuje, zvolte prosím jiné.', FLASH_FAILED);
		}

	}

	public function handleDeleteContent() {
		// signal handle
	}
}