<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsListTypePage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsListTypePage
{
    private $result;
    private $pageId;
    private $limitResult = 40;
    private $resultPage;
    
    function getResultPage()
    {
        return $this->resultPage;
    }
    
    public function listPages($pageId = null)
    {
        $this->pageId = (int) $pageId;
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(
                URLADM . 'list-type-page/list-types-pages');
        $pagination->condition($this->pageId, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) numResult FROM adms_tipos_paginas");
        $this->resultPage = $pagination->getResult();
        
        $tipoPg = new \Module\administrative\Models\helper\AdmsRead();
        $tipoPg->fullRead(
                "SELECT *
                FROM adms_tipos_paginas
                ORDER BY ordem ASC
                LIMIT :limit
                OFFSET  :offset",
                "limit={$this->limitResult}&offset={$pagination->getOffSet()}");
        $this->result = $tipoPg->getResult();
        return $this->result;
    }
}
