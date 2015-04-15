<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 20:31, 20. 3. 2015
 */

namespace App\AdminModule\Model;

use Nette;

/**
 * Class MysqlExporter
 * @package App\AdminModule\Model
 */
final class MysqlExporter extends Nette\Object
{
	/**
	 *
	 */
	const BACKUP_DIR = "DatabaseBackup";

	/**
	 * @var Nette\Database\Context
	 */
	private $database;

	/**
	 * @var
	 */
	private $exportedSql;

	/**
	 * @var string
	 */
	private $filename;


	/**
	 * @param Nette\Database\Context $database
	 */
	function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;

		$dsn = explode(";", $this->database->getConnection()->dsn);
		$dbName = str_replace('dbname=', '', $dsn[count($dsn) - 1]);
		$this->filename = self::BACKUP_DIR . '/' . "Mysql-" . $dbName . "-exported-" . date("j-n-Y-H-i-s") . ".sql";
	}


	/**
	 * @return string
	 */
	public function getFilename()
	{
		return $this->filename;
	}

	/**
	 * @param $table
	 */
	private function dropTable($table)
	{
		$this->exportedSql .= "DROP TABLE IF EXISTS " . $table . ";\n\n";
	}

	/**
	 * @param $table
	 */
	private function createTable($table)
	{
		$result = $this->database->query('SHOW CREATE TABLE ' . $table)->fetch();
		$this->exportedSql .= $result["Create Table"] . ";\n\n";
	}

	/**
	 * @param $table
	 */
	private function insertData($table)
	{
		foreach ($this->database->table($table)->fetchAll() as $row) {
			$insert = "INSERT INTO $table VALUES (";
			$values = [];
			foreach ($this->database->getStructure()->getColumns($table) as $collum) {
				$collumName = $collum['name'];
				$values[] = "'" . $row->$collumName . "'";
			}
			$insert .= implode(", ", $values) . ");\n";
			$this->exportedSql .= $insert;
		}
	}

	/**
	 *
	 */
	public function export()
	{
		$tables = $this->database->getStructure()->getTables();
		foreach ($tables as $tableObj) {
			$table = $tableObj['name'];
			$this->dropTable($table);
			$this->createTable($table);
			$this->insertData($table);
			$this->exportedSql .= "\n\n";
		}
	}

	/**
	 *
	 */
	public function save()
	{
		@mkdir(self::BACKUP_DIR);
		try {
			$handle = fopen($this->filename, 'w+');
			fwrite($handle, $this->exportedSql);
			fclose($handle);
		} catch (\Exception $e) {
			throw new Nette\IOException("Cannot write result to file $this->filename");
		}
	}
}