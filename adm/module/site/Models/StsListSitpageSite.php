<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsListSitpageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsListSitpageSite
{
    private $result;
    private $pageId;
    private $limitResult = 10;
    private $resultPg;
    
    function getResultPg()
    {
        return $this->resultPg;
    }

    public function listSituationPagesSite($pageId = null)
    {
        $this->pageId = (int) $pageId;
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(
                URLADM . 'list-situation-page/list-info-situation-page');
        $pagination->condition($this->pageId, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) numResult FROM sts_situacaos_pgs");
        $this->resultPg = $pagination->getResult();
        
        $listSitPage = new \Module\administrative\Models\helper\AdmsRead();
        $listSitPage->fullRead(
                "SELECT
                    sitPg.id, sitPg.nome, col.cor color
                FROM
                    sts_situacaos_pgs sitPg
                INNER JOIN
                    adms_cors col
                    ON col.id = sitPg.adms_cor_id
                ORDER BY sitPg.id ASC
                LIMIT :limit
                OFFSET :offset",
                "limit={$this->limitResult}&offset={$pagination->getOffSet()}");
        $this->result = $listSitPage->getResult();
        return $this->result;
    }
}
