<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 22:39, 3. 2. 2015
 * @copyright 2015 Jan Kotrba
 */


namespace App;

use Nette,
    Nette\Application\Routers\RouteList,
    Nette\Application\Routers\Route;


/**
 * Router factory.
 */
class RouterFactory
{

    /**
     * @return \Nette\Application\IRouter
     */
    public static function createRouter()
    {
        $router = new RouteList();
        $prefix = "";
        // Admin Router

		// Menu
		$router[] = new Route($prefix . 'admin/menu', 'Admin:Menu:allMenus');
		$router[] = new Route($prefix . 'admin/menu/seznam', 'Admin:Menu:allMenus');
		$router[] = new Route($prefix . 'admin/menu/pridat', 'Admin:Menu:addMenu');
		$router[] = new Route($prefix . 'admin/menu/upravit[/<id>]', 'Admin:Menu:editMenu');



		// Test
        $router[] = new Route($prefix . 'admin/test/odeslat-email', 'Admin:Test:sendEmail');

        // nastaveni uctu
        $router[] = new Route($prefix . 'admin/muj-ucet/', 'Admin:MyProfile:default');

        // Plugin 'Článek'
        $router[] = new Route($prefix . 'admin/clanek/pridat/[<id>]', 'Admin:ManageArticle:add');

        // Obsah
        $router[] = new Route($prefix . 'admin/obsah/pridat-polozku/', 'Admin:Content:addContent');
        $router[] = new Route($prefix . 'admin/obsah/vsechny-polozky/', 'Admin:Content:allContent');

        // Struktura
        $router[] = new Route($prefix . 'admin/struktura-stranek/', 'Admin:Structure:default');

        // Login
        $router[] = new Route($prefix . 'admin/zapomenute-heslo', 'Admin:Sign:forgot');
        $router[] = new Route($prefix . 'admin/prihlasit-se', 'Admin:Sign:in');
        // Logout
        $router[] = new Route($prefix . 'admin/odhlasit-se', 'Admin:Sign:out');

        // Spravci
        $router[] = new Route($prefix . 'admin/spravci/', 'Admin:Users:list');
        $router[] = new Route($prefix . 'admin/spravci/pridat/', 'Admin:Users:add');
        $router[] = new Route($prefix . 'admin/spravci/upravit/[<userID>]', 'Admin:Users:edit');
        $router[] = new Route($prefix . 'admin/spravci/seznam/', 'Admin:Users:list');

        // Dashboard
        $router[] = new Route($prefix . 'admin/', 'Admin:Homepage:default');


        // Front Router
        $router[] = new Route($prefix . 'roznov-pod-radhostem/<action>[/<id>]', 'Front:Roznov:default');
        $router[] = new Route($prefix . 'valasske-mezirici/<action>[/<id>]', 'Front:Valmez:default');
        $router[] = new Route($prefix . 'bowling/<action>[/<id>]', 'Front:Bowling:default');
        $router[] = new Route($prefix . '', 'Front:Homepage:default');
        return $router;
    }

}
