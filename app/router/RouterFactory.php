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

        // Admin Router
        // Test
        $router[] = new Route('admin/test/odeslat-email', 'Admin:Test:sendEmail');

        // nastaveni uctu
        $router[] = new Route('admin/muj-ucet/', 'Admin:MyProfile:default');

        // Plugin 'Článek'
        $router[] = new Route('admin/clanek/pridat/[<id>]', 'Admin:ManageArticle:add');

        // Obsah
        $router[] = new Route('admin/obsah/pridat-polozku/', 'Admin:Content:addContent');
        $router[] = new Route('admin/obsah/vsechny-polozky/', 'Admin:Content:allContent');

        // Struktura
        $router[] = new Route('admin/struktura-stranek/', 'Admin:Structure:default');

        // Login
        $router[] = new Route('admin/zapomenute-heslo', 'Admin:Sign:forgot');
        $router[] = new Route('admin/prihlasit-se', 'Admin:Sign:in');
        // Logout
        $router[] = new Route('admin/odhlasit-se', 'Admin:Sign:out');

        // Spravci
        $router[] = new Route('admin/spravci/', 'Admin:Users:list');
        $router[] = new Route('admin/spravci/pridat/', 'Admin:Users:add');
        $router[] = new Route('admin/spravci/upravit/[<userID>]', 'Admin:Users:edit');
        $router[] = new Route('admin/spravci/seznam/', 'Admin:Users:list');

        // Dashboard
        $router[] = new Route('admin/', 'Admin:Homepage:default');


        // Front Router
        $router[] = new Route('roznov-pod-radhostem/<action>[/<id>]', 'Front:Roznov:default');
        $router[] = new Route('valasske-mezirici/<action>[/<id>]', 'Front:Valmez:default');
        $router[] = new Route('bowling/<action>[/<id>]', 'Front:Bowling:default');
        $router[] = new Route('', 'Front:Homepage:default');
        return $router;
    }

}
