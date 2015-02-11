<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 2:36, 11. 2. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Model;

use Nette;

class BranchManager extends Nette\Object
{

    /** @var Nette\Database\Context @inject */
    private $database;

    private $branches;

    private $currentBranch;

    function __construct(Nette\Database\Context $database, Nette\Application\UI\Presenter $session)
    {
        $this->database = $database;
        $this->currentBranch = $session->getSession('selectedBranch'); // data = null
        $session->getSession('selectedBranch')->setExpiration(0, 'selectedBranch');
        foreach ($this->database->table('web_branches')->fetchAll() as $branch) {
            $this->branches[$branch->id] = $branch->name;
        }
    }

    public function selectDefault()
    {
        $this->currentBranch->data = $this->getDefault();
    }

    public function getDefault()
    {
        return [
            'id' => key($this->branches),
            'title' => $this->branches[key($this->branches)]
        ];
    }

    public function getCurrent()
    {
        return $this->currentBranch->data;
    }

    public function getCurrentName()
    {
        return $this->currentBranch->data['title'];
    }

    public function getAll()
    {
        return $this->branches;
    }

    public function setNew($id)
    {
        $this->currentBranch->data = [
            'id' => $id,
            'title' => $this->branches[$id]
        ];
    }
}