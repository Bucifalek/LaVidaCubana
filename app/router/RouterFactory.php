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
		// Back end


        $router = new RouteList();
        $prefix = "";
        // Admin Router

		// Menu
		$router[] = new Route($prefix . 'admin/menu', 'Admin:menu:all');
		$router[] = new Route($prefix . 'admin/menu/seznam', 'Admin:menu:all');
		$router[] = new Route($prefix . 'admin/menu/pridat', 'Admin:menu:addMenu');
		$router[] = new Route($prefix . 'admin/menu/struktura', 'Admin:menu:structure');
		$router[] = new Route($prefix . 'admin/menu/upravit/[<id>]', 'Admin:menu:edit');
		$router[] = new Route($prefix . 'admin/menu/pridat-sekci/[<id>]', 'Admin:menu:addSection');
		$router[] = new Route($prefix . 'admin/menu/pridat-položku/[<id>]', 'Admin:menu:addItem');

        // Support
        $router[] = new Route($prefix . 'admin/podpora', 'Admin:support:contact');

		// Test
        $router[] = new Route($prefix . 'admin/test/odeslat-email', 'Admin:test:sendEmail');

        // nastaveni uctu
        $router[] = new Route($prefix . 'admin/muj-ucet/', 'Admin:myProfile:default');

        // Plugin 'Článek'
        $router[] = new Route($prefix . 'admin/clanek/pridat/[<id>]', 'Admin:manageArticle:add');

        // Obsah
        $router[] = new Route($prefix . 'admin/obsah/pridat-polozku/', 'Admin:content:addContent');
        $router[] = new Route($prefix . 'admin/obsah/vsechny-polozky/', 'Admin:content:allContent');

        // Struktura
        $router[] = new Route($prefix . 'admin/struktura-stranek/', 'Admin:structure:default');

        // Login
        $router[] = new Route($prefix . 'admin/zapomenute-heslo', 'Admin:sign:forgot');
        $router[] = new Route($prefix . 'admin/prihlasit-se', 'Admin:sign:in');

        // Logout
        $router[] = new Route($prefix . 'admin/odhlasit-se', 'Admin:sign:out');

        // Spravci
        $router[] = new Route($prefix . 'admin/spravci/', 'Admin:users:list');
        $router[] = new Route($prefix . 'admin/spravci/pridat/', 'Admin:users:add');
        $router[] = new Route($prefix . 'admin/spravci/upravit/[<userID>]', 'Admin:users:edit');
        $router[] = new Route($prefix . 'admin/spravci/seznam/', 'Admin:users:list');

        // Dashboard
        $router[] = new Route($prefix . 'admin/', 'Admin:dashboard:default');

        // Front Router
        $router[] = new Route($prefix . 'roznov-pod-radhostem/<action>[/<id>]', 'Web:Roznov:default');
        $router[] = new Route($prefix . 'valasske-mezirici/<action>[/<id>]', 'Web:Valmez:default');
        $router[] = new Route($prefix . 'bowling/<action>[/<id>]', 'Web:Bowling:default');
        $router[] = new Route($prefix . 'bowling/chci-si-zahrat', 'Web:Bowling:play');
        $router[] = new Route($prefix . 'bowling/bowlingova-liga', 'Web:Bowling:league');
        $router[] = new Route($prefix . '', 'Web:Homepage:default');
        return $router;
    }

}
