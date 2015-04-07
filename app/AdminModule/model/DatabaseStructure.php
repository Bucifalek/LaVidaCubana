<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 21:06, 24. 3. 2015
 */

namespace App\AdminModule\Model;

use Nette;

/**
 * Class DatabaseStructure
 * @package App\AdminModule\Model
 */
class DatabaseStructure extends Nette\Object
{

	/**
	 * Bowling players table
	 */
	const BOWLING_PLAYERS = "bowling_players";
	/**
	 * Bowling teams table
	 */
	const BOWLING_TEAMS = "bowling_teams";
	/**
	 * Web branches table
	 */
	const BRANCHES = "branches";
	/**
	 * Main page news table
	 */
	const MAIN_NEWS = "main_news";
	/**
	 * Pages table
	 */
	const PAGES = "pages";
	/**
	 * Pages content table
	 */
	const PAGES_CONTENT = "pages_content";
	/**
	 * Users table
	 */
	const USERS = "users";

}