<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 16:29, 18. 2. 2015
 * @copyright 2015 Jan Kotrba
 */
 
namespace Nette\Application\UI;

use Nette, Nette\Forms\Controls;

class myForm extends Nette\Forms\Form implements Nette\Utils\IHtmlString {
/*
	public function addText($name, $label = NULL, $cols = NULL, $maxLength = NULL)
	{
		$control = new Controls\TextInput($label, $maxLength);
		$control->setAttribute('size', $cols);
		return $this[$name] = $control;
	}
*/
	public function setExpiration() {

	}

}