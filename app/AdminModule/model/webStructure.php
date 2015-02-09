<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 23:47, 9. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Model;

use Nette,
    App\AdminModule\Model;

class webStructure extends Nette\Object {

    /** @var Nette\Database\Context @inject */
    private $database;

    function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    public function get() {
        $result = [];
        $allBranches = $this->database->table('web_structure')->fetchAll();
        foreach($allBranches as $branch) {
            /*$result[$branch->name][] = ['title' => 'ex1',
                'presenter' => 'ex2',
                'action' => 'ex3',
                'theme' =>'ex4'];*/
            $subBranches = $this->database->table('web_content')->where(['parent_branch' => $branch->branch_id])->fetchAll();
            if(!$subBranches) {
                $result[$branch->name] = [];
            } else {
                foreach($subBranches as $contentRow) {
                    $result[$branch->name][] = [
                        'title' => $contentRow->title,
                        'presenter' => $contentRow->presenter,
                        'action' => $contentRow->action,
                        'theme' => $contentRow->theme
                    ];
                }
            }

        }
        return $result;
    }

}