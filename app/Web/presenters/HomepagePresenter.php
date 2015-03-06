<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 18:23, 4. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\WebModule\Presenters;

use Nette,
    Nette\Application\UI;

class HomepagePresenter extends BasePresenter
{

    public function renderDefault()
    {
        $this->template->anyVariable = 'any value';
        $this->template->akceRoznov = 'Máme pro vás ruskou kávu.';
        $this->template->akceValmez = 'Máme pro vás kubanskou kávu.';
        $this->template->akceBowling = 'Tady je inventůra.';
    }

    public function createComponentWelcome()
    {
        $control = new welcomeControl();
        $control->text = 'Vitejte, todle je moje první funkční komponenta.';
        return $control;
    }

}