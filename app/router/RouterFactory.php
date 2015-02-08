<?php

namespace App;

use Nette,
	Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route,
	Nette\Application\Routers\SimpleRouter;


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

		// Admin Route

		$router[] = new Route('admin/zapomenute-heslo', array(
			'module' => 'Admin',
			'presenter' => 'Sign',
			'action' => 'Forgot',
			'id' => NULL,
		));

		$router[] = new Route('admin/prihlasit-se', array(
			'module' => 'Admin',
			'presenter' => 'Sign',
			'action' => 'in',
			'id' => NULL,
		));

		$router[] = new Route('admin/spravci/upravit/<id>', array(
			'module' => 'Admin',
			'presenter' => 'Users',
			'action' => 'edit',
			'id' => NULL,
		));
		$router[] = new Route('admin/spravci/seznam/<id>', array(
			'module' => 'Admin',
			'presenter' => 'Users',
			'action' => 'list',
			'id' => NULL,
		));
		$router[] = new Route('admin/spravci/pridat/<id>', array(
			'module' => 'Admin',
			'presenter' => 'Users',
			'action' => 'add',
			'id' => NULL,
		));

		$router[] = new Route('admin/spravci/<action>/<id>', array(
			'module' => 'Admin',
			'presenter' => 'Users',
			'action' => 'default',
			'id' => NULL,
		));

		$router[] = new Route('admin/napoveda/<action>/<id>', array(
			'module' => 'Admin',
			'presenter' => 'Faq',
			'action' => 'default',
			'id' => NULL,
		));

		$router[] = new Route('admin/<presenter>/<action>/<id>', array(
			'module' => 'Admin',
			'presenter' => 'Homepage',
			'action' => 'default',
			'id' => NULL,
		));

		// Front Route
		$router[] = new Route('roznov-pod-radhostem/<action>[/<id>]', 'Front:Roznov:default');
		$router[] = new Route('valasske-mezirici/<action>[/<id>]', 'Front:Valmez:default');
		$router[] = new Route('bowling/<action>[/<id>]', 'Front:Bowling:default');
		$router[] = new Route('<presenter>/<action>/<id>', array(
			'module' => 'Front',
			'presenter' => 'Homepage',
			'action' => 'default',
			'id' => NULL,
		));

		return $router;
	}

}
