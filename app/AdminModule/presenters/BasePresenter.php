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
            'Menu' => [
                'Přidat menu' => 'Menu:newMenu',
                'Aktuální struktura' => 'Menu:currentStructure',
            ],
            'Obsah' => [
                'Přidat položku' => 'Articles:add',
                'Všechny položky' => 'Articles:allContent',
            ],
            'Soubory' => [
                'Nahrávání souborů' => 'Files:upload',
                'Všechny soubory' => 'Files:allFiles',
            ]
        ];

        $menu->sections['Moduly'] = [
            'Fotogalerie' => [
                'Přidat obrázky' => 'PluginGallery:addImage',
                'Struktura galerie' => 'PluginGallery:galleryStructure',
            ],
            'Aktuality' => [
                'Přidat novou aktualitu' => 'NewsFeed:addPost',
                'Seznam aktualit' => 'NewsFeed:allPosts',
                'Nastavení' => 'NewsFeed:config',
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