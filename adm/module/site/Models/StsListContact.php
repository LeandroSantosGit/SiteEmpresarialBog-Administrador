<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}


/**
 * Description of StsListContact
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsListContact
{
    private $result;
    private $pageId;
    private $limitResult = 40;
    private $resultPg;
    
    function getResultPg()
    {
        return $this->resultPg;
    }

    public function listInfoContact($pageId = null)
    {
        $this->pageId = (int) $pageId;
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(
                URLADM . 'list-contact/list-info-contact');
        $pagination->condition($this->pageId, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) numResult FROM sts_contatos");
        $this->resultPg = $pagination->getResult();
        
        $listContact = new \Module\administrative\Models\helper\AdmsRead();
        $listContact->fullRead(
                "SELECT *
                FROM sts_contatos
                ORDER BY id DESC
                LIMIT :limit
                OFFSET :offset",
                "limit={$this->limitResult}&offset={$pagination->getOffSet()}");
        $this->result = $listContact->getResult();
        return $this->result;
    }
}
