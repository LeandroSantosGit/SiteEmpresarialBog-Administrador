<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsListColor
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsListColor
{
    private $result;
    private $pageId;
    private $limitResult = 20;
    private $resultPg;
    
    function getResultPg()
    {
        return $this->resultPg;
    }

    public function listColors($pageId = null)
    {
        $this->pageId = (int) $pageId;
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(
                URLADM . 'list-color/list-colors');
        $pagination->condition($this->pageId, $this->limitResult);
        $pagination->pagination(
                "SELECT COUNT(id) as numResult
                FROM adms_cors", 
                "ordem=" . $_SESSION['userOrdemAcesso']);
        $this->resultPg = $pagination->getResult();
        
        $listColor = new \Module\administrative\Models\helper\AdmsRead();
        $listColor->fullRead(
                "SELECT id, nome, cor
                FROM adms_cors
                ORDER BY id ASC
                LIMIT :limit
                OFFSET :offset",
                "limit={$this->limitResult}&offset={$pagination->getOffSet()}");
        $this->result = $listColor->getResult();
        return $this->result;
    }
}
