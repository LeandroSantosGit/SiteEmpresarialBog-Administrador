<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsListSituationPage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsListSituationPage
{
    private $result;
    private $pageId;
    private $limitResult = 40;
    private $resultPg;
    
    function getResultPg()
    {
        return $this->resultPg;
    }

    public function listSituationPages($pageid = null)
    {
        $this->pageId = (int) $pageid;
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(
                URLADM . 'list-situation-page/list-situation-pages');
        $pagination->condition($this->pageId, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) numResult FROM adms_situacao_paginas");
        $this->resultPg = $pagination->getResult();
        
        $listSitPg = new \Module\administrative\Models\helper\AdmsRead();
        $listSitPg->fullRead(
                "SELECT *
                FROM adms_situacao_paginas
                ORDER BY nome ASC
                LIMIT :limit
                OFFSET :offset",
                "limit={$this->limitResult}&offset={$pagination->getOffSet()}");
        $this->result = $listSitPg->getResult();
        return $this->result;
    }
}
