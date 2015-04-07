<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 9:43, 20. 3. 2015
 */

namespace App\AdminModule\Presenters;

use Nette\Application\UI;

class MainNewsControl extends UI\Control
{

    public $title;
    public $redirect;

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param mixed $redirect
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;
    }


    public function render()
    {
        $template = $this->template;
        $template->setFile(__DIR__ . '/MainNewsControl.latte');
        if (empty($this->title)) {
            $this->title = "Aktuálně pro vás nic nemáme.";
        }
        $template->title = $this->title;
        $template->redirect = $this->redirect;
        $template->render();
    }
}