<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 19:37, 4. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette\Application\UI;
use Tracy\Debugger;

class MenuControl extends UI\Control
{

	private $sections;

	/**
	 * @param $name
	 * @param $data
	 * @return mixed
	 */
	public function addSection($name, $data)
	{
		return $this->sections[$name] = $data;
	}

	public function render()
	{
		$this->template->setFile(__DIR__ . '/MenuControl.latte');
		$this->template->sections = $this->sections;

		$this->template->wrapRoute = function ($arg) {
			if (is_array($arg)) {
				$value = reset($arg);
				$route = (is_array($value)) ? explode(":", reset($value)) : explode(":", $value);
				unset($route[count($route) - 1]);
				$result = implode(":", $route) . ":*";

				return $result;
			}
			$route = explode(":", $arg);
			unset($route[count($route) - 1]);
			$result = implode(":", $route) . ":*";

			return $result;
		};

		$this->template->glyph = function ($arg) {
			$parts = explode("|", $arg);
			if (count($parts) > 1) {
				return "glyphicons-" . $parts[count($parts) - 1];
			} else {
				$report = "For action '" . $arg . "' there's no icon!";
				Debugger::barDump($report);

				return "glyphicons-book_open";
			}
		};

		$this->template->name = function ($arg) {
			$parts = explode("|", $arg);

			return $parts[0];
		};

		$this->template->anyData = function ($arg) {
			$exploded = explode(",", $arg);
			if (count($exploded) > 1) {
				return true;
			}

			return false;
		};

		$this->template->parseLink = function ($arg) {
			$exploded = explode(", ", $arg);

			return $exploded[0];
		};
		$this->template->parseData = function ($arg) {
			$exploded = explode(",", $arg);

			return str_replace(' ', '', $exploded[1]);
		};
		$this->template->secondLevelSelected=false;

		$this->template->changeSecondLevel = function () {
			$this->changeSecondLevel();
		};

		$this->template->render();
	}

	public function changeSecondLevel() {
		if($this->template->secondLevelSelected == false) {
			$this->template->secondLevelSelected = true;
			Debugger::barDump("zmemeno");

		}
		Debugger::barDump($this->template->secondLevelSelected);
		return $this;
	}
}