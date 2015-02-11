<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 22:39, 10. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Model;

use Nette;

class ModulesManager extends Nette\Object
{

    /** @var Nette\Database\Context @inject */
    private $database;

    function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    private function getModuleOptions($id)
    {
        $row = $this->database->table('web_modules')->where(['id' => $id])->fetch();
        return json_decode($row->options);
    }

    private function getModule($id)
    {
        return $this->database->table('web_modules')->where(['id' => $id])->fetch();
    }

    public function getAll()
    {
        $result = [];
        $webContent = $this->database->table('web_content')->fetchAll();
        foreach ($webContent as $row) { // Foreach used modules
            $moduleOptions = $this->getModuleOptions($row->module);
            $module = $this->getModule($row->module);
            $moduleActions = [];
            foreach ($moduleOptions->actions as $name => $action) {
                $moduleActions[$name] = $module->manage_presenter . ":" . $action;
            }
            $result[$module->name . "|" . $moduleOptions->icon] = $moduleActions;
        }
        return $result;
    }
}