<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsListTypeArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsListTypeArticle
{
    private $result;
    private $pageId;
    private $limitResult = 40;
    private $resultPg;
    
    function getResultPg()
    {
        return $this->resultPg;
    }
    
    public function listTypeArticle($pageId = null)
    {
        $this->pageId = (int) $pageId;
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(
                URLADM . 'list-type-article/list-info-type-article');
        $pagination->condition($this->pageId, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) numResult FROM sts_tps_artigos");
        $this->resultPg = $pagination->getResult();
                
        $listTpArticle = new \Module\administrative\Models\helper\AdmsRead();
        $listTpArticle->fullRead(
                "SELECT *
                FROM sts_tps_artigos
                ORDER BY id ASC
                LIMIT :limit
                OFFSET :offset",
                "limit={$this->limitResult}&offset={$pagination->getOffSet()}");
        $this->result = $listTpArticle->getResult();
        return $this->result;
    }
    
    
}
