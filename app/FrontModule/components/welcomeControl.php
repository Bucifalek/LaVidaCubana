<?php
namespace App\FrontModule\Presenters;

use Nette\Application\UI;

class welcomeControl extends UI\Control {

    public $text;

    public function render() {
        $template = $this->template;
        $template->setFile(__DIR__.'/welcomeControl.latte');
        $template->text = $this->text;
        $template->render();
    }
}