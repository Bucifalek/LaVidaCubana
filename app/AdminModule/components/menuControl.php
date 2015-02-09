<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 19:37, 4. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette\Application\UI;

class menuControl extends UI\Control
{

    public $sections;

    public function render()
    {
        $template = $this->template;
        $template->setFile(__DIR__ . '/menuControl.latte');
        $template->sections = $this->sections;

        $template->wrapRoute = function ($arg) {
            $route = explode(":", reset($arg));
            unset($route[count($route) - 1]);
            return implode(":", $route) . ":*";
        };

        $template->glyph = function ($arg) {
            $parts = explode("|", $arg);
            if (count($parts) > 1) {
                return "glyphicons-" . $parts[count($parts) - 1];
            }
            return "glyphicons-book_open";
        };

        $template->name = function ($arg) {
            $parts = explode("|", $arg);
            return $parts[0];
        };

        $percentage = 100 - (100 * disk_free_space('.') / disk_total_space('.'));

        $percentage = rand(0,100);
        if($percentage <= 25) {
            $template->usedSpaceColor = "success ";
        } else if($percentage > 25 AND $percentage < 85) {
            $template->usedSpaceColor = "warning";
        } else if($percentage >= 85) {
            $template->usedSpaceColor = "danger";
        }
        $template->usedSpacePercentage = $percentage;
        $template->render();
    }
}