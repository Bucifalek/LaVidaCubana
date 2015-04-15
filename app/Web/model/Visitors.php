<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 16:06, 9. 4. 2015
 */

namespace App\WebModule\Model;

use App\AdminModule\Model\DatabaseStructure;
use Nette;

/**
 * Class Visitors
 * @package App\WebModule\Model
 */
class Visitors extends Nette\Object
{

	/**
	 * @var Nette\Database\Context
	 */
	private $database;

	/**
	 * @var
	 */
	private $filter;

	/**
	 * @var
	 */
	private $timeInterval;

	/**
	 * @param Nette\Database\Context $database
	 */
	function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}


	/**
	 * @param array $data
	 */
	public function newVisitor(array $data)
	{
		$this->database->table(DatabaseStructure::WEB_VISITORS)->insert($data);
	}


	/**
	 * @param Nette\Application\UI\Presenter $presenter
	 * @param Nette\Http\IRequest $request
	 */
	public function visited(Nette\Application\UI\Presenter $presenter, Nette\Http\IRequest $request)
	{
		$values = [
			'ip'      => $request->getRemoteAddress(),
			'session' => $request->getCookie('PHPSESSID'),
			'url'     => $request->getUrl(),
			'route'   => $presenter->getName() . ':' . $presenter->getAction(),
		];

		if (!$this->database->table(DatabaseStructure::WEB_VISITORS)->where($values)->limit(1)->count()) {
			$values['timestamp'] = time();
			$this->newVisitor($values);
		}
	}

	/**
	 * @param $key
	 * @param null $timeCondition
	 * @return array
	 */
	public function from($key, $timeCondition = null)
	{
		$query = $this->database->table(DatabaseStructure::WEB_VISITORS)->where('route LIKE ', '%' . $key . '%');

		if ($timeCondition) {
			$this->timeInterval = [
				'from' => $timeCondition[0],
				'to'   => $timeCondition[1],
			];
			/*
			Debugger::barDump('Zobrazit od: ' . date('Y-m-d H:i:s', $timeCondition[0]));
			Debugger::barDump('Zobrazit do: ' . date('Y-m-d H:i:s', $timeCondition[1]));
			*/
			$query->where('timestamp >= ', $timeCondition[0]);
			$query->where('timestamp <= ', $timeCondition[1]);
		}

		return $query->fetchAll();
	}

	/**
	 * @param $key
	 * @return array|null
	 */
	public function filter($key)
	{
		$this->filter = [];
		$today = strtotime(date('Y-m-d 23:59:59'));
		switch ($key) {
			case 'today':
				$this->filter['day'] = 'Dnes';

				return $this->filter['interval'] = [strtotime(date('Y-m-d')), $today];
				break;
			case 'yesterday':
				$this->filter['day'] = 'Včera';

				return $this->filter['interval'] = [strtotime('-1 day', strtotime(date('Y-m-d'))), strtotime(date('Y-m-d'))];
				break;
			case 'lastweek':
				$this->filter['day'] = 'Poslední týden';

				return $this->filter['interval'] = [strtotime('-7 day', strtotime(date('Y-m-d'))), $today];
				break;
			case 'lastmonth':
				$this->filter['day'] = 'Poslední měsíc';

				return $this->filter['interval'] = [strtotime('-31 day', strtotime(date('Y-m-d'))), $today];
				break;
			default:
				$this->filter['day'] = 'Vše';
				$this->filter['interval'] = [false, $today];

				return null;
				break;
		}
	}

	/**
	 * @return mixed
	 */
	public function getFilter()
	{
		return $this->filter;
	}

}