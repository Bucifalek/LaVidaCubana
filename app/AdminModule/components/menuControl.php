<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 19:37, 4. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette\Application\UI;
use Tracy\Debugger;

class menuControl extends UI\Control
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
		$template = $this->template;
		$template->setFile(__DIR__ . '/menuControl.latte');
		$template->sections = $this->sections;

		$template->wrapRoute = function ($arg) {
			if (is_array($arg)) {
				$value = reset($arg);
				if (is_array($value)) {
					$route = explode(":", reset($value));
				} else {
					$route = explode(":", $value);
				}

				unset($route[count($route) - 1]);
				$result = implode(":", $route) . ":*";

				return $result;
			}
			$route = explode(":", $arg);
			unset($route[count($route) - 1]);
			$result = implode(":", $route) . ":*";

			return $result;
		};

		$template->glyph = function ($arg) {
			$parts = explode("|", $arg);
			if (count($parts) > 1) {
				return "glyphicons-" . $parts[count($parts) - 1];
			} else {
				$report = "For action '".$arg."' there's no icon!";
				Debugger::barDump($report);
				return "glyphicons-book_open";
			}
		};

		$template->name = function ($arg) {
			$parts = explode("|", $arg);

			return $parts[0];
		};

		$template->render();
	}
}