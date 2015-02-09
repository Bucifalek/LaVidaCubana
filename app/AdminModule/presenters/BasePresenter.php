<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 20:38, 3. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette,
    App\AdminModule\Model,
    Nette\Security;

class BasePresenter extends Nette\Application\UI\Presenter
{
    /** @var Model\userManager @inject */
    private $userManager;

    function __construct(Model\userManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function beforeRender()
    {
        if ($this->getUser()->isLoggedIn()) {
            $userData = $this->user->getIdentity()->getData();
            $this->template->firstName = $userData['firstname'];
            $this->template->lastName = $userData['lastname'];
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
         * Only glyphicons
         */
        $menu = new menuControl();
        /*$menu->sections['CMS'] =
            [
                'Dashboard|home' => 'Homepage:default',
                'Obsah|flash' =>
                    [
                        'Přidat|warning_sign' => 'Obsah:pridat',
                        'link 2|warning_sign' => 'presenter5',
                    ],
                'simple 4' => 'presenter6',
                'deeeeepmenu' =>
                    [
                        'first level' => 'presenter7',
                        'drop second' =>
                            [
                                'simple 5' => 'presenter8',
                                'simple 6' => 'presenter9'
                            ]
                    ]
            ];*/

        $menu->sections['Obsah'] = [
            'Menu|list' => [
                'Přidat menu|circle_plus' => 'Menu:newMenu',
                'Aktuální struktura|notes_2' => 'Menu:currentStructure',
            ],
            'Obsah' => [
                'Přidat položku|circle_plus' => 'Articles:add',
                'Všechny položky|notes_2' => 'Articles:allContent',
            ],
            'Soubory|file' => [
                'Nahrávání souborů|file_import' => 'Files:upload',
                'Všechny soubory|folder_open' => 'Files:allFiles',
            ]
        ];

        $menu->sections['Moduly'] = [
            'Fotogalerie|camera' => [
                'Přidat obrázky|circle_plus' => 'PluginGallery:addImage',
                'Struktura galerie|align_left' => 'PluginGallery:galleryStructure',
            ],
            'Aktuality|tags' => [
                'Přidat novou aktualitu|circle_plus' => 'NewsFeed:addPost',
                'Seznam aktualit|notes_2' => 'NewsFeed:allPosts',
                'Nastavení|settings' => 'NewsFeed:config',
            ]
        ];

        $menu->sections['Systém'] = [
            'Správci|group' =>
                [
                    'Přidat|user_add' => 'Users:add',
                    'Seznam správců|adress_book' => 'Users:list'
                ],
        ];
        return $menu;
    }
}