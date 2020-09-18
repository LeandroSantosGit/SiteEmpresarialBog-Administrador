<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsListSituation
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsListSituation
{
    private $result;
    private $pageId;
    private $limitResult = 40;
    private $resultPg;
    
    function getResultPg()
    {
        return $this->resultPg;
    }

    public function listSituations($pageId = null)
    {
        $this->pageId = (int) $pageId;
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(
                URLADM . 'list-situation/list-situations');
        $pagination->condition($this->pageId, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) numResult FROM adms_situacao");
        $this->resultPg = $pagination->getResult();
        
        $listSit = new \Module\administrative\Models\helper\AdmsRead();
        $listSit->fullRead(
                "SELECT sit.*, col.cor sitCor 
                FROM adms_situacao sit
                INNER JOIN adms_cors col
                    ON col.id = sit.adms_cor_id
                ORDER BY sit.id ASC
                LIMIT :limit
                OFFSET :offset",
                "limit={$this->limitResult}&offset={$pagination->getOffSet()}");
        $this->result = $listSit->getResult();
        return $this->result;
    }
}
