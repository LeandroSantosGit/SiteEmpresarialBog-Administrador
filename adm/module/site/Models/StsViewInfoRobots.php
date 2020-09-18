<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsViewInfoRobots
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsViewInfoRobots
{
    private $result;
    private $dadoId;
    
    public function viewInfoRobots($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewRobots = new \Module\administrative\Models\helper\AdmsRead();
        $viewRobots->fullRead(
                "SELECT *
                FROM sts_robots
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewRobots->getResult();
        return $this->result;
    }
}
