<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsListMenu
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsListMenu
{
    private $result;
    private $pageId;
    private $limitResult = 40;
    private $resultPage;
    
    function getResultPage()
    {
        return $this->resultPage;
    }

    public function listItensMenu($pageId = null)
    {
        $this->pageId = (int) $pageId;
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(
                URLADM . 'list-menu/list-itens-menu');
        $pagination->condition($this->pageId, $this->limitResult);
        $pagination->pagination(
                "SELECT COUNT(id) numResult
                FROM adms_menus");
        $this->resultPage = $pagination->getResult();
        
        $listPages = new \Module\administrative\Models\helper\AdmsRead();
        $listPages->fullRead(
                "SELECT
                    men.*,
                    sit.nome sitNome,
                    cor.cor crCor
                FROM
                    adms_menus men
                INNER JOIN
                    adms_situacao sit
                    ON sit.id = men.adms_situacao_id
                INNER JOIN
                    adms_cors cor
                    ON cor.id = sit.adms_cor_id
                ORDER BY ordem ASC
                LIMIT :limit
                OFFSET :offset",
                "limit={$this->limitResult}&offset={$pagination->getOffSet()}");
        $this->result = $listPages->getResult();
        return $this->result;
    }
}
