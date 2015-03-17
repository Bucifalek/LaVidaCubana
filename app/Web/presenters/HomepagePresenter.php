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
        $this->template->akceRoznov = 'AKCE: Máme pro vás ruskou kávu a je opravdu dost dobrá, ale to není podstatné.';
        $this->template->akceValmez = 'AKCE: Máme pro vás kubánskou kávu a je opravdu dost dobrá, ale to není podstatné.';
        $this->template->akceBowling = 'AKCE: Tady je inventura a na tom ani tak nějak nesejde, je přece úterý.';
    }

    public function createComponentWelcome()
    {
        $control = new welcomeControl();
        $control->text = 'Vitejte, todle je moje první funkční komponenta.';
        return $control;
    }

}