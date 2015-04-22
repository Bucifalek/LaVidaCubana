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

		// System
		$router[] = new Route('admin/export-databaze', 'Admin:Helper:databaseExport');
		$router[] = new Route('admin/zmenit-sekci[/<target>]', 'Admin:Dashboard:changeBranch');

		// Teams
		$router[] = new Route('admin/tymy', 'Admin:Team:default');
		$router[] = new Route('admin/tymy/pridat', 'Admin:Team:add');
		$router[] = new Route('admin/tymy/upravit[/<id>]', 'Admin:Team:edit');

		// Individuals
		$router[] = new Route('admin/jednotlivci[/strana[/<page=1>]]', 'Admin:Individual:default');
		$router[] = new Route('admin/jednotlivci/pridat', 'Admin:Individual:add');
		$router[] = new Route('admin/jednotlivci/upravit[/<id>]', 'Admin:Individual:edit');

		// News
		$router[] = new Route('admin/aktualne/pridat', 'Admin:News:add');
		$router[] = new Route('admin/aktualne/upravit/<id=0>', 'Admin:News:edit');
		$router[] = new Route('admin/aktualne[/<page=1>]', 'Admin:News:default');

		// Dalsi informace
		$router[] = new Route('admin/informace/oteviraci-doba', 'Admin:Info:openTime');
		$router[] = new Route('admin/informace/cenik-bowlingu', 'Admin:Info:bowlingPrice');
		$router[] = new Route('admin/informace/pro-cleny', 'Admin:Info:forMembers');

		// Rozpis
		$router[] = new Route('admin/liga/<season>/rozpis', 'Admin:League:draft');
		$router[] = new Route('admin/liga/<season>/jednotliva-kola', 'Admin:League:rounds');
		$router[] = new Route('admin/liga/<season>/pridat-kolo', 'Admin:League:addRound');
		$router[] = new Route('admin/liga/<season>/pridat-team', 'Admin:League:addTeam');
		$router[] = new Route('admin/liga/pridat-dalsi-rok', 'Admin:League:addYear');

		// Vysledky
		$router[] = new Route('admin/vysledky/top-3', 'Admin:Top:default');
		$router[] = new Route('admin/vysledky/pridat[/<step=vybrat-sezonu>]', 'Admin:Result:add');
		$router[] = new Route('admin/vysledky/<season>', 'Admin:Result:default');

		// Uvodni novinky
		$router[] = new Route('admin/uvodni-novinky[/<key>]', 'Admin:MainNews:edit');


		// Muj ucet
		$router[] = new Route('admin/muj-ucet/', 'Admin:MyProfile:default');

		// Login
		$router[] = new Route('admin/zapomenute-heslo', 'Admin:Sign:forgot');
		$router[] = new Route('admin/prihlasit-se', 'Admin:Sign:in');

		// Logout
		$router[] = new Route('admin/odhlasit-se', 'Admin:Sign:out');

		// Spravci
		$router[] = new Route('admin/spravci/', 'Admin:Users:default');
		$router[] = new Route('admin/spravci/pridat/', 'Admin:Users:add');
		$router[] = new Route('admin/spravci/upravit/[<userID>]', 'Admin:Users:edit');

		// Dashboard
		$router[] = new Route('admin/', 'Admin:Dashboard:default');

		// Support
		$router[] = new Route('admin/podpora', 'Admin:Support:contact');


		// Front Router
		$router[] = new Route('roznov-pod-radhostem/', 'Web:Roznov:default');
		$router[] = new Route('valasske-mezirici/', 'Web:Valmez:default');

		// Bowling Router
		$router[] = new Route('bowling/', 'Web:Bowling:default');
		$router[] = new Route('bowling/chci-si-zahrat', 'Web:Bowling:play');
		$router[] = new Route('bowling/bowlingova-liga[/strana/<page=1>]', 'Web:Bowling:league');
		$router[] = new Route('bowling/pravidla', 'Web:Bowling:rules');
		$router[] = new Route('bowling/rozpis', 'Web:Bowling:draft');
		$router[] = new Route('bowling/aktualne', 'Web:Bowling:news');
		$router[] = new Route('bowling/top-3', 'Web:Bowling:top');

		$router[] = new Route('', 'Web:Homepage:default');
		$router[] = new Route('www', 'Web:Homepage:default');
		$router[] = new Route('<not-found>', 'Web:Homepage:notFound');

		return $router;
	}

}
