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

		// System
		$router[] = new Route($prefix . 'admin/export-databaze', 'Admin:Helper:databaseExport');
		$router[] = new Route($prefix . 'admin/zmenit-sekci[/<target>]', 'Admin:Dashboard:changeBranch');

		// Teams
		$router[] = new Route($prefix . 'admin/teamy', 'Admin:Team:list');
		$router[] = new Route($prefix . 'admin/teamy/pridat', 'Admin:Team:add');
		$router[] = new Route($prefix . 'admin/teamy/upravit[/<teamID>]', 'Admin:Team:edit');

		// Individuals
		$router[] = new Route($prefix . 'admin/jednotlivci[/strana[/<page=1>]]', 'Admin:Individual:default');
		$router[] = new Route($prefix . 'admin/jednotlivci/pridat', 'Admin:Individual:add');

		// News
		$router[] = new Route($prefix . 'admin/aktualne', 'Admin:News:history');
		$router[] = new Route($prefix . 'admin/aktualne/pridat', 'Admin:News:add');

		// Dalsi informace
		$router[] = new Route($prefix . 'admin/informace/oteviraci-doba', 'Admin:Info:openTime');
		$router[] = new Route($prefix . 'admin/informace/cenik-bowlingu', 'Admin:Info:bowlingPrice');
		$router[] = new Route($prefix . 'admin/informace/pro-cleny', 'Admin:Info:forMembers');

		// Rozpis / jarni cast
		// admin/liga/<year>/<season>/rozpis
		$router[] = new Route($prefix . 'admin/liga/<year>/<season>/rozpis', 'Admin:League:draft');









		// ...
		$router[] = new Route($prefix . 'admin/liga[/<action>]', 'Admin:League:*');
		$router[] = new Route($prefix . 'admin/vysledky[/<action>][/<year>]', 'Admin:Result:*');
		$router[] = new Route($prefix . 'admin/uvodni-novinky[/<key>]', 'Admin:MainNews:edit');


		// nastaveni uctu
		$router[] = new Route($prefix . 'admin/muj-ucet/', 'Admin:MyProfile:default');

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
		$router[] = new Route($prefix . 'admin/', 'Admin:Dashboard:default');

		// Support
		$router[] = new Route($prefix . 'admin/podpora', 'Admin:Support:contact');



		// Front Router
		$router[] = new Route($prefix . 'roznov-pod-radhostem/', 'Web:Roznov:default');
		$router[] = new Route($prefix . 'valasske-mezirici/', 'Web:Valmez:default');


		$router[] = new Route($prefix . 'bowling/', 'Web:Bowling:default');
		$router[] = new Route($prefix . 'bowling/chci-si-zahrat', 'Web:Bowling:play');
		$router[] = new Route($prefix . 'bowling/bowlingova-liga', 'Web:Bowling:league');

		$router[] = new Route($prefix . '', 'Web:Homepage:default');
		$router[] = new Route($prefix . '<not-found>', 'Web:Homepage:notFound');



		return $router;
	}

}
