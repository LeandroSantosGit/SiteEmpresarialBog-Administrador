<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsListSobCompany
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsListSobCompany
{
    private $result;
    private $pageId;
    private $limitResult = 10;
    private $resultPg;
    
    function getResultPg()
    {
        return $this->resultPg;
    }
    
    public function listInfoSobCompany($pageId = null)
    {
        $this->pageId = (int) $pageId;
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(
                URLADM . 'list-sob-company/list-info-company');
        $pagination->condition($this->pageId, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) numResult FROM sts_sob_empresa");
        $this->resultPg = $pagination->getResult();
        
        $listSobCompany = new \Module\administrative\Models\helper\AdmsRead();
        $listSobCompany->fullRead(
                "SELECT
                    emp.id, emp.titulo, emp.imagem, emp.ordem,
                    sit.nome nomeSit, col.cor color
                FROM
                    sts_sob_empresa emp
                INNER JOIN
                    adms_situacao sit 
                    ON sit.id = emp.adms_sit_id
                INNER JOIN
                    adms_cors col
                    ON col.id = sit.adms_cor_id
                ORDER BY emp.ordem ASC
                LIMIT :limit
                OFFSET :offset",
                "limit={$this->limitResult}&offset={$pagination->getOffSet()}");
        $this->result = $listSobCompany->getResult();
        return $this->result;
    }
}
