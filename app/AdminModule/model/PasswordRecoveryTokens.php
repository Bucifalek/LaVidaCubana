<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 17:33, 23. 4. 2015
 */

namespace App\AdminModule\Model;

use Nette;
use Tracy\Debugger;

/**
 * Class PasswordRecoveryTokens
 * @package App\AdminModule\Model
 */
class PasswordRecoveryTokens extends Nette\Object
{

	/**
	 * @var Nette\Database\Context
	 */
	private $database;

	/**
	 * @var
	 */
	private $token;

	/**
	 * @param Nette\Database\Context $database
	 */
	function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

	/**
	 * @param $token
	 * @return bool
	 * @throws \Exception
	 */
	public function isValid($token)
	{
		$query = $this->database->table(DatabaseStructure::USERS_RECOVERY_TOKENS)->where('token', $token);
		if (!$query->count()) {
			throw new \Exception('Neplatný pokus o obnovení hesla.');
		}

		$data = $query->fetch();
		if ((time() - $data['timestamp']) > 1800) {
			throw new \Exception('Platnost tohoto odkazu vypršela. Na obnovení máte 30 minut od odeslání žádosti.');
		}

		return true;
	}


	/**
	 * @return string
	 */
	public function generate()
	{
		return $this->token = Nette\Utils\Random::generate(50, '0-9a-zA-Z');
	}

	/**
	 * @throws Nette\Application\AbortException
	 */
	public function save()
	{
		if (!$this->token) {
			throw new Nette\Application\AbortException('Zadny token, nejdriv musis generovat');
		}
		$this->database->table(DatabaseStructure::USERS_RECOVERY_TOKENS)->insert(['token' => $this->token, 'timestamp' => time()]);
	}
}