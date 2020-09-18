<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsListSituationUser
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsListSituationUser
{
    private $result;
    private $pageId;
    private $limitResult = 40;
    private $resultPg;
    
    function getResultPg()
    {
        return $this->resultPg;
    }

    public function listSituationUsers($pageId = null)
    {
        $this->pageId = (int) $pageId;
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(
                URLADM . 'list-situation-user/list-situation-users');
        $pagination->condition($this->pageId, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) numResult FROM adms_situacao_users");
        $this->resultPg = $pagination->getResult();
        
        $listSitUser = new \Module\administrative\Models\helper\AdmsRead();
        $listSitUser->fullRead(
                "SELECT sit.*, col.cor sitCor
                FROM adms_situacao_users sit
                INNER JOIN adms_cors col
                    ON col.id = sit.adms_cor_id
                ORDER BY sit.id ASC
                LIMIT :limit
                OFFSET :offset",
                "limit={$this->limitResult}&offset={$pagination->getOffSet()}");
        $this->result = $listSitUser->getResult();
        return $this->result;
    }
}
