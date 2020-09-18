<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsListRobots
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsListRobots
{
    private $result;
    private $pageId;
    private $limitResult = 10;
    private $resultPg;
    
    function getResultPg()
    {
        return $this->resultPg;
    }

    public function listInfoRobots($pageId = null)
    {
        $this->pageId = (int) $pageId;
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(
                URLADM . 'list-robots/list-info-robots');
        $pagination->condition($this->pageId, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) numResult FROM sts_robots");
        $this->resultPg = $pagination->getResult();
        
        $listRobots = new \Module\administrative\Models\helper\AdmsRead();
        $listRobots->fullRead(
                "SELECT *
                FROM sts_robots
                ORDER BY id ASC
                LIMIT :limit
                OFFSET :offset",
                "limit={$this->limitResult}&offset={$pagination->getOffSet()}");
        $this->result = $listRobots->getResult();
        return $this->result;
    }
}
