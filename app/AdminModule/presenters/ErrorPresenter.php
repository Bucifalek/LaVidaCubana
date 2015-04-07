<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 11:57, 8. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette;

/**
 * Class ErrorPresenter
 * @package App\AdminModule\Presenters
 */
final class ErrorPresenter extends BasePresenter
{

    /**
     * @param $exception
     */
    public function renderDefault($exception)
    {
        if ($exception instanceof BadRequestException) {
            $this->setView('404'); // load template 404.phtml
        } else {
            $this->setView('500'); // load template 500.phtml
        }
    }
}
