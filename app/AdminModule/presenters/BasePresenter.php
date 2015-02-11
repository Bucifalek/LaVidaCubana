<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 20:38, 3. 2. 2015
 * @copyright 2015 Jan Kotrba
 */


namespace App\AdminModule\Presenters;

use Nette,
    App\AdminModule\Model,
    Nette\Security,
    Tracy\Debugger;

Debugger::$maxDepth = 10; // default: 3
Debugger::$maxLen = 50; // default: 150

class BasePresenter extends Nette\Application\UI\Presenter
{
    /** @var Model\userManager @inject */
    private $userManager;

    /** @var Nette\Database\Context @inject */
    private $database;

    private $modulesManager;

    function __construct(Model\userManager $userManager, Nette\Database\Context $database)
    {
        $this->userManager = $userManager;
        $this->database = $database;
        $this->modulesManager = new Model\ModulesManager($this->database);
    }

    public function beforeRender()
    {
        if ($this->getUser()->isLoggedIn()) {
            $userData = $this->user->getIdentity()->getData();
            $this->template->firstName = $userData['firstname'];
            $this->template->lastName = $userData['lastname'];
            $this->template->avatar = $userData['avatar'];
            $this->template->email = $userData['email'];
            try {
                $this->userManager->isUserBanned($this->getUser());
            } catch (Security\AuthenticationException $e) {
                $this->user->logout(TRUE);
                $this->flashMessage($e->getMessage(), FLASH_WARNING);
                $this->redirect('Sign:in');
            }
        }
        $this->template->getFlashType = function ($arg) {
            $e = explode("|", $arg);
            return @$e[0];
        };
        $this->template->getFlashIcon = function ($arg) {
            $e = explode("|", $arg);
            return @$e[1];
        };
    }

    public function createComponentMenu()
    {
        /**
         * Only glyphicons icons in menu
         */
        $menu = new menuControl;
        // Struktura CMS
        $menu->addSection('Obsah',
            [
                'Menu|list' => [
                    'Přidat menu|circle_plus' => 'Menu:newMenu',
                    'Aktuální struktura|notes_2' => 'Menu:currentStructure',
                ],
                'Obsah' => [
                    'Přidat položku|circle_plus' => 'Content:addContent',
                    'Všechny položky|notes_2' => 'Articles:allContent',
                ],
            ]);

        // Pouzite moduly, dynamic
        foreach ($this->modulesManager->getAll() as $moduleName => $moduleActions) {
            $menu->addSection('Použité moduly',
                [$moduleName => $moduleActions]
            );
        }

/*
        $menu->sections['Použité moduly'] = [
            'Článek' => [
                'Přidat článek' => 'add'
            ],
            'Fotogalerie|camera' => [
                'Přidat obrázky|circle_plus' => 'PluginGallery:addImage',
                'Struktura galerie|align_left' => 'PluginGallery:galleryStructure',
            ],
            'Aktuality|tags' => [
                'Přidat novou aktualitu|circle_plus' => 'NewsFeed:addPost',
                'Seznam aktualit|notes_2' => 'NewsFeed:allPosts',
                'Nastavení|settings' => 'NewsFeed:config',
            ],
            'Soubory|file' => [
                'Nahrávání souborů|file_import' => 'Files:upload',
                'Všechny soubory|folder_open' => 'Files:allFiles',
            ]
        ];*/

        // Struktura CMS
        $menu->addSection('Systém', [
            'Správci|group' =>
                [
                    'Přidat|user_add' => 'Users:add',
                    'Seznam správců|adress_book' => 'Users:list'
                ],
            'Testy|electricity' =>
                [
                    'Emaily' => 'Test:sendEmail'
                ]
        ]);
        return $menu;
    }

    public function handleChangeProject($changeTo)
    {
        die($changeTo);
    }
}