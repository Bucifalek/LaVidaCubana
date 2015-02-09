<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 22:35, 5. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use App\AdminModule\Model,
    Nette\Application\UI,
    Nette\Database\Context,
    Nette\Security\Passwords,
    Utils;

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

    /**
     * Get all users from database and insert them into template variables
     */
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


    /**
     * Ban user and send email notification
     */
    public function handleBanUser($id)
    {
        try {
            $userDetails = $this->userManager->getDetails($id);
            $this->userManager->ban($id);
        } catch (\Exception $e) {
            $this->flashMessage($e->getMessage(), FLASH_WARNING);
            $this->redirect('Users:list');
        }

        if (isset($userDetails)) {
            try {
                $myMailer = new Model\myMailer;
                $myMailer->setHtmlBody(
                    __DIR__ . '/../templates/EmailTemplates/banUserEmail.latte',
                    [
                        'firstname' => $userDetails->real_firstname,
                        'lastname' => $userDetails->real_lastname,
                        'user' => $userDetails->user,
                        'website' => 'La VIDA Cubana',
                        'website_url' => 'http://cms.jkotrba.net/admin/'
                    ]
                )
                    ->addTo($userDetails->email)
                    ->setFrom("cms@jkotrba.net")
                    ->setSubject("Váš účet byl zablokován!");
                $myMailer->sendEmail();
            } catch (\Exception $e) {
                $this->flashMessage($e->getMessage(), FLASH_WARNING);
                $this->redirect('Users:list');
            }
            $this->flashMessage("Uživatel " . $userDetails->user . " byl zablokován a na jeho email " . $userDetails->email . " bylo odesláno oznámení.", FLASH_SUCCESS);
        }
        $this->redirect('Users:list');
    }


    /**
     * Un ban user, no notification
     */
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


    /**
     * Create new password and send it to user via email
     */
    public function handleRegenPass($id)
    {
        $strongPassword = Utils\passGenerator::generateStrongPassword();
        try {
            $userDetails = $this->userManager->getDetails($id);
            $this->userManager->newPassword($id, $strongPassword, Passwords::hash($strongPassword));
        } catch (\Exception $e) {
            $this->flashMessage($e->getMessage(), FLASH_WARNING);
            $this->redirect('Users:list');
        }

        if (isset($userDetails)) {
            try {
                $myMailer = new Model\myMailer;
                $myMailer->setHtmlBody(
                    __DIR__ . '/../templates/EmailTemplates/passwordChangeEmail.latte',
                    [
                        'user' => $userDetails->user,
                        'website' => 'La VIDA Cubana',
                        'website_url' => 'http://cms.jkotrba.net/admin/',
                        'newPassword' => $strongPassword
                    ]
                )
                    ->addTo($userDetails->email)
                    ->setFrom("cms@jkotrba.net")
                    ->setSubject("Vašemu účtu bylo vygenerováno nové heslo");
                $myMailer->sendEmail();
            } catch (\Exception $e) {
                $this->flashMessage($e->getMessage(), FLASH_WARNING);
                $this->redirect('Users:list');
            }
            $this->flashMessage("Nové heslo bylo vygenerováno a na příslušný email bylo odesláno oznámení o změně.", FLASH_SUCCESS);
        }
        $this->redirect('Users:list');
    }


    /**
     * Delete user and send notification
    */
    public function handleDeleteUser($id)
    {
        try {
            $userDetails = $this->userManager->getDetails($id);
            $this->userManager->delete($id);
        } catch (\Exception $e) {
            $this->flashMessage($e->getMessage(), FLASH_WARNING);
            $this->redirect('Users:list');
        }

        if (isset($userDetails)) {
            try {
                $myMailer = new Model\myMailer;
                $myMailer->setHtmlBody(
                    __DIR__ . '/../templates/EmailTemplates/deleteUserEmail.latte',
                    [
                        'user' => $userDetails->user,
                        'website' => 'La VIDA Cubana',
                        'website_url' => 'http://cms.jkotrba.net/admin/'
                    ]
                )
                    ->addTo($userDetails->email)
                    ->setFrom("cms@jkotrba.net")
                    ->setSubject("Váš účet byl smazán");
                $myMailer->sendEmail();
            } catch (\Exception $e) {
                $this->flashMessage($e->getMessage(), FLASH_WARNING);
                $this->redirect('Users:list');
            }
            $this->flashMessage("Účet byl úspěšně smazán, správce již nemá přístup do systému.", FLASH_SUCCESS);
        }
        $this->redirect('Users:list');
    }


    /**
     * Create form to update user data
    */
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


    /**
     * Saves updated data to database, no notification
    */
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
        $this->flashMessage('Změny účtu byly uloženy');
        $this->redirect('Users:list');
    }


    /**
     * Create form to add user to database
    */
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

    
    /**
     * Add user to database and send email notification
    */
    public function addUserFormSucceeded(UI\Form $form, $values)
    {
        $strongPassword = Utils\passGenerator::generateStrongPassword();
        try {
            $this->userManager->add(array(
                'user' => $values->username,
                'password' => Passwords::hash($strongPassword),
                'password_pure' => $strongPassword,
                'real_firstname' => $values->firstname,
                'real_lastname' => $values->lastname,
                'email' => $values->email,
                'banned' => '0'
            ));
        } catch (\Exception $e) {
            $this->flashMessage($e->getMessage(), FLASH_WARNING);
        }

        try {
            $myMailer = new Model\myMailer;
            $myMailer->setHtmlBody(
                __DIR__ . '/../templates/EmailTemplates/deleteUserEmail.latte',
                [
                    'username' => $values->username,
                    'firstname' => $values->firstname,
                    'lastname' => $values->lastname,
                    'password' => $strongPassword,
                    'website' => 'La VIDA Cubana',
                    'website_url' => 'http://cms.jkotrba.net/admin/'
                ]
            )
                ->addTo($values->email)
                ->setFrom("cms@jkotrba.net")
                ->setSubject("Vytvoření účtu");
            $myMailer->sendEmail();
        } catch (\Exception $e) {
            $this->flashMessage($e->getMessage(), FLASH_WARNING);
            $this->redirect('Users:list');
        }
        $this->flashMessage("Správce přidán do systému, nyní se může snadno přihlásit.", FLASH_SUCCESS);
        $this->redirect('Users:list');
    }
}