<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 22:35, 5. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use App\AdminModule\Model,
    Nette\Application\UI,
    Nette\Security\Passwords,
    Nette\Database\Context,
    Latte,
    Nette\Mail\Message,
    Utils\passGenerator;

class UsersPresenter extends BasePresenter
{
    /** @var Context @inject */
    private $database;

    /** @var Model\UserManager @inject */
    private $userManager;

    function __construct(Context $database, Model\UserManager $userManager)
    {
        parent::__construct($userManager);
        $this->database = $database;
        $this->userManager = $userManager;
    }

    public function renderList()
    {
        $this->template->currentUsers = $this->database->table('admin_users')->fetchAll();
    }

    public function renderEdit($userID)
    {
        if (!isset($userID)) {
            $this->flashMessage('Neplatna URL');
            $this->redirect('Users:list');
        }
        $this->template->userData = $this->userManager->getDetails($userID);
    }

    public function handleBanUser($id)
    {
        try {
            $this->userManager->ban($id);

            $details = $this->userManager->getDetails($id);
            $latte = new Latte\Engine;
            $myMailer = new Model\myMailer;
            $mail = new Message;
            $mail->addTo($details->email)
                ->setFrom("cms@jkotrba.net")
                ->setSubject("Váš účet byl zablokován")
                ->setHtmlBody($latte->renderToString(__DIR__ . '/../templates/EmailTemplates/banUserEmail.latte',
                    [
                        'firstname' => $details->real_firstname,
                        'lastname' => $details->real_lastname,
                        'user' => $details->user,
                        'website' => 'La VIDA Cubana',
                        'website_url' => 'http://cms.jkotrba.net/admin/'
                    ]));
            $myMailer->send($mail);
        } catch (\Exception $e) {
            $this->flashMessage($e->getMessage(), FLASH_WARNING);
        }
        $this->flashMessage("Správce byl zablokován a na email " . $details->email . " bylo odesláno oznámení.", FLASH_WARNING);
        $this->redirect('Users:list');
    }

    public function handleUnBanUser($id)
    {
        try {
            $this->userManager->unBan($id);
        } catch (\Exception $e) {
            $this->flashMessage($e->getMessage(), FLASH_WARNING);
        }
        $this->flashMessage("Správce odblokován.", FLASH_SUCCESS);
        $this->redirect('Users:list');
    }

    public function handleRegenPass($id)
    {
        $password = passGenerator::generateStrongPassword();
        try {
            $this->userManager->newPassword($id, $password, Passwords::hash($password));
        } catch (\Exception $e) {
            $this->flashMessage($e->getMessage(), FLASH_WARNING);
        }
        $this->flashMessage("Nové heslo bylo vygenerováno.", FLASH_SUCCESS);
        $this->redirect('Users:list');
    }

    public function handleDeleteUser($id)
    {
        try {
            $this->userManager->delete($id);
        } catch (\Exception $e) {
            $this->flashMessage($e->getMessage(), FLASH_WARNING);
        }
        $this->flashMessage("Správce byl smazán a nadále již nemá přistup do systému.", FLASH_SUCCESS);
        $this->redirect('Users:list');
    }


    public function createComponentUpdateUserForm()
    {
        $form = new UI\Form;
        $form->addHidden('id');
        $form->addText('firstname')->setRequired('Nezadali jste jméno.');
        $form->addText('lastname')->setRequired('Nezadali jste prijmeni');
        $form->addText('email')->setRequired('nezadali jste email');
        $form->addtext('username')->setRequired('nezadlai jste jmeno pro prihlaseni');
        $form->addSubmit('updateUser', 'Uložit změny');
        $form->onSuccess[] = array($this, 'updateUserFormSucceeded');
        return $form;
    }

    public function updateUserFormSucceeded(UI\Form $form, $values)
    {
        try {
            $this->userManager->update($values->id, [
                'real_firstname' => $values->firstname,
                'real_lastname' => $values->lastname,
                'user' => $values->username,
                'email' => $values->email
            ]);
        } catch (\Exception $e) {
            $this->flashMessage($e->getMessage(), FLASH_WARNING);
        }
        $this->flashMessage('Uživatelske informace ulozeny');
        $this->redirect('Users:list');
    }

    public function createComponentAddUserForm()
    {
        $form = new UI\Form;
        $form->addText('firstname')->setRequired('Nezadali jste jméno.');
        $form->addText('lastname')->setRequired('Nezadali jste prijmeni');
        $form->addText('email')->setRequired('nezadali jste email');
        $form->addtext('username')->setRequired('nezadlai jste jmeno pro prihlaseni');
        $form->addSubmit('addUser', 'Přidat');
        $form->onSuccess[] = array($this, 'addUserFormSucceeded');
        return $form;
    }

    public function addUserFormSucceeded(UI\Form $form, $values)
    {
        $password = passGenerator::generateStrongPassword();
        try {
            $this->userManager->add(array(
                'user' => $values->username,
                'password' => Passwords::hash($password),
                'password_pure' => $password,
                'real_firstname' => $values->firstname,
                'real_lastname' => $values->lastname,
                'email' => $values->email,
                'banned' => '0'
            ));
        } catch (\Exception $e) {
            $this->flashMessage($e->getMessage(), FLASH_WARNING);
        }

        $this->flashMessage("Správce přidán do systému, nyní se může snadno přihlásit.", FLASH_SUCCESS);
        $this->redirect('Users:list');
    }
}