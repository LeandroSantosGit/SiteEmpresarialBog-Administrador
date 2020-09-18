<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsListTypepgSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsListTypepgSite
{
    private $result;
    private $pageId;
    private $limitResult = 40;
    private $resultPg;
    
    function getResultPg()
    {
        return $this->resultPg;
    }

    public function listInfoTypePageSite($pageId = null)
    {
        $this->pageId = (int) $pageId;
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(
                URLADM . 'list-typepg-site/list-info-typepg-site');
        $pagination->condition($this->pageId, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) numResult FROM sts_tipos_paginas");
        $this->resultPg = $pagination->getResult();
        
        $listTypePg = new \Module\administrative\Models\helper\AdmsRead();
        $listTypePg->fullRead(
                "SELECT *
                FROM sts_tipos_paginas
                ORDER BY ordem ASC
                LIMIT :limit
                OFFSET :offset",
                "limit={$this->limitResult}&offset={$pagination->getOffSet()}");
        $this->result = $listTypePg->getResult();
        return $this->result;
    }
}
