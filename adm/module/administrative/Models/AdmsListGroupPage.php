<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsListGroupPage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsListGroupPage
{
    private $result;
    private $pageId;
    private $limitResult = 40;
    private $resultPage;
    
    function getResultPage()
    {
        return $this->resultPage;
    }

    public function listGrupPage($pageId = null)
    {
        $this->pageId = (int) $pageId;
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(
                URLADM . 'list-group-page/list-groups-pages');
        $pagination->condition(($this->pageId), $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) AS numResult FROM adms_grupos_paginas");
        $this->resultPage = $pagination->getResult();
        
        $listGroupPg = new \Module\administrative\Models\helper\AdmsRead();
        $listGroupPg->fullRead(
                "SELECT *
                FROM adms_grupos_paginas
                ORDER BY ordem ASC
                LIMIT :limit
                OFFSET :offset",
                "limit={$this->limitResult}&offset={$pagination->getOffSet()}");
        $this->result = $listGroupPg->getResult();
        return $this->result;
    }
}
