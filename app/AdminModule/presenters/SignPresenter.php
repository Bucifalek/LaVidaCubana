<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 18:23, 4. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette,
    App\Model,
    Nette\Application\UI;

class SignPresenter extends BasePresenter
{

    public function beforeRender()
    {
        parent::beforeRender();
    }

    protected function createComponentLoginForm()
    {
        $form = new UI\Form;
        $form->addText('username', 'Name:')->setRequired('Nezadali jste jméno.');
        $form->addPassword('password', 'Password:')->setRequired('Nezadali jste heslo.');
        $form->addSubmit('login');
        $form->onSuccess[] = array($this, 'loginFormSucceeded');
        return $form;
    }

    public function loginFormSucceeded(UI\Form $form, $values)
    {
        $values = $form->values;
        try {
            $this->getUser()->login($values->username, $values->password);
            $this->flashMessage('Nyní jste úspěšně přihlášen.', FLASH_SUCCESS);
            $this->redirect('Homepage:');
        } catch (Nette\Security\AuthenticationException $e) {
            $this->flashMessage($e->getMessage(), FLASH_WARNING);
            $this->redirect('Sign:in');
        }
    }

    public function actionOut()
    {
        $this->user->logout(TRUE);
        $this->redirect('Sign:in');
    }
}