<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 8:13, 18. 3. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette,
	App\AdminModule\Model;

class MainNewsPresenter extends BasePresenter
{

	function __construct() {

	}

	public function renderEdit($key)
	{
		// TODO
		if($key == "roznov") {
			$this->template->title = "Rožnov pod Radhoštěm";
		} else if($key == "valmez") {
			$this->template->title = "Valašské meziříčí";
		} else {
			$this->template->title = ucfirst($key);
		}

	}

}