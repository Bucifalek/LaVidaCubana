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

class ContentPresenter extends BasePresenter
{
	private $database;

	private $contentManager;
	private $webModules;

	function __construct(Nette\Database\Context $database, Model\UserManager $userManager)
	{
		parent::__construct($userManager, $database);
		$this->database = $database;
		$this->contentManager = new Model\ContentManager($database);
		$this->webModules = $this->contentManager->getAllModules();

	}

	private function prepareWebContent()
	{
		$webModules = [];
		$content = $this->contentManager->getContent();
		$modules = $this->webModules;
		foreach ($content as $row) {
			$title = $modules[$row->module]['name'] . " : " . $row->title;
			$webModules[$title] = 'params';
		}
		return $webModules;
	}

	public function renderAddContent()
	{

	}

	public function renderAllContent()
	{

		$this->template->webContent = $this->prepareWebContent();
	}
}