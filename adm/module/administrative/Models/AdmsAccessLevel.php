<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsAccessLevel
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsAccessLevel
{
    private $result;
    private $pageId;
    private $limitResult = 10;
    private $resultPage;
    
    function getResultPage()
    {
        return $this->resultPage;
    }
    
    public function listStatusAccess($pageId = null)
    {
        $this->pageId = (int) $pageId;
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(URLADM . 'access-level/list-access');
        $pagination->condition($this->pageId, $this->limitResult);
        $pagination->pagination(
                "SELECT COUNT(id) numResult
                FROM adms_niveis_acessos
                WHERE ordem >=:ordem",
                "ordem=" . $_SESSION['userOrdemAcesso']);
        $this->resultPage = $pagination->getResult();
        
        $listAccess = new \Module\administrative\Models\helper\AdmsRead();
        $listAccess->fullRead(
                "SELECT id, nome, ordem
                FROM adms_niveis_acessos
                WHERE ordem >=:ordem
                ORDER BY ordem ASC
                LIMIT :limit
                OFFSET :offset",
                "ordem=" . $_SESSION['userOrdemAcesso']
                . "&limit={$this->limitResult}&offset={$pagination->getOffSet()}");
        $this->result = $listAccess->getResult();
        return $this->result;
    }
}
