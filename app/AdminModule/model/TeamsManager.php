<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 13:58, 21. 3. 2015
 */

namespace App\AdminModule\Model;

use Nette;

class TeamsManager extends Nette\Object
{

    private $database;

    function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    public function getAll()
    {
        return $this->database->table(DatabaseStructure::BOWLING_TEAMS)->order('score DESC')->fetchAll();
    }

    public function total()
    {
        return $this->database->table(DatabaseStructure::BOWLING_TEAMS)->count();
    }

    public function getPage($limit, $offset)
    {
        $teamsFinal = [];
        $teams = $this->database->table(DatabaseStructure::BOWLING_TEAMS)->limit($limit, $offset)->order('score DESC')->fetchAll();
        foreach ($teams as $team) {
            $teamsFinal[] = [
                'name' => $team->name,
                'score' => $team->score,
                'score_avg' => $team->score_avg,
                'index' => $team->index,
                'matches' => $team->matches,
                'helpers' => $team->helpers,
                'points' => $team->points,
            ];
        }

        return $teamsFinal;
    }
}