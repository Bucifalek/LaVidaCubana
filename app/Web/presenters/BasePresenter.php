<?php

namespace App\WebModule\Presenters;

use App\WebModule\Model;
use Nette;
use Tracy\Debugger;


/**
 * Base presenter for all application presenters.
 */
class BasePresenter extends Nette\Application\UI\Presenter
{
	private $visitors;

	public function __construct(Model\Visitors $visitors) {
		$this->visitors = $visitors;
	}

	public function beforeRender() {
		$this->visitors->visited($this, $this->getHttpRequest());
	}
}
