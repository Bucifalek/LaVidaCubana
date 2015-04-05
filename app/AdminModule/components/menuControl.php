<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 19:37, 4. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette\Application\UI;
use Tracy\Debugger;

/**
 * Class MenuControl
 * @package App\AdminModule\Presenters
 */
class MenuControl extends UI\Control
{

	/**
	 * @var
	 */
	private $sections;


	/**
	 * @return string
	 */
	private function getCurrentLink()
	{
		return str_replace('Admin:', null, $this->getPresenter()->getName()) . ":*";
	}

	/**
	 *
	 */
	private function selectCurrentLink()
	{
		$currentRoute = str_replace('Admin:', null, $this->getPresenter()->getName()) . ":" . $this->getPresenter()->getAction();
		$parameters = $this->getPresenter()->getRequest()->getParameters();
		if (count($parameters) > 1) {
			$currentRoute .= ", " . implode(", ", $parameters);
		}
		$currentRoute = str_replace(', ' . $this->getPresenter()->getAction(), '', $currentRoute);
		Debugger::barDump('currentRoute# ' . $currentRoute);


		/*
				foreach($this->sections as $sKey => $section) {
					$key = array_search($currentRoute, $section);
					if($key) {
						//$this->sections[$sKey][$key] = $currentRoute . "@current@";
						Arrays::renameKey($this->sections[$sKey], $key, '@current@' . $key);

					}
				}
				Debugger::barDump($this->sections);
		*/

	}

	/**
	 * @param $name
	 * @param $data
	 * @return mixed
	 */
	public function addSection($name, $data)
	{
		return $this->sections[$name] = $data;
	}

	/**
	 * @param $arg
	 * @return string
	 */
	private function wrapRoute($arg)
	{
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
	}

	/**
	 *
	 */
	public function render()
	{
		$this->template->setFile(__DIR__ . '/MenuControl.latte');
		$this->template->sections = $this->sections;
		// Add Anotation to menu
		$this->selectCurrentLink();


		$this->template->currentFirst = str_replace('Admin:', null, $this->getPresenter()->getName()) . ":*";
		//Debugger::barDump("currentFirst: " . $this->template->currentFirst);

		$this->template->currentSecond = str_replace('Admin:', null, $this->getPresenter()->getName()) . ":" . $this->getPresenter()->getAction();
		//Debugger::barDump("currentSecond: " . $this->template->currentSecond);

		$this->template->currentLink = str_replace('Admin:', null, $this->getPresenter()->getName()) . ":" . $this->getPresenter()->getAction();

		// Current route construct
		$currentRoute = str_replace('Admin:', null, $this->getPresenter()->getName()) . ":" . $this->getPresenter()->getAction();
		$parameters = $this->getPresenter()->getParameters();
		array_pop($parameters);
		if (count($parameters)) {
			$currentRoute .= ", " . implode(", ", $parameters);
		}
		//Debugger::barDump($currentRoute);


		/*$parameters = $this->getPresenter()->getParameters();
		array_pop($parameters);
		Debugger::barDump($parameters);

		if (count($this->getPresenter()->getParameters()) > 2) {
			$this->template->currentLink = $this->template->currentLink . implode(" ,", $this->getPresenter()->getParameters());
		}*/
		//Debugger::barDump("currentLink: " . $this->template->currentLink);

		$this->template->wrapRoute = function ($arg) {
			$this->wrapRoute($arg);
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
		$this->template->anySecondData = function ($arg) {
			$exploded = explode(",", $arg);
			if (count($exploded) > 2) {
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
			if (!$exploded) {
				return null;
			}

			return str_replace(' ', '', $exploded[1]);
		};
		$this->template->parseSecondData = function ($arg) {
			$exploded = explode(",", $arg);
			if (!$exploded) {
				return null;
			}

			return str_replace(' ', '', $exploded[2]);
		};
		$this->template->render();
	}

}