<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsListCarousel
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsListCarousel
{
    private $result;
    private $pageId;
    private $limitResult = 40;
    private $resultPg;
    
    function getResultPg()
    {
        return $this->resultPg;
    }

    public function listCarousel($pageId)
    {
        $this->pageId = (int) $pageId;
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(
                URLADM . 'list-carousel/list-carousels');
        $pagination->condition($this->pageId, $this->limitResult);
        $pagination->pagination(
                "SELECT COUNT(id) numResult FROM sts_carousels");
        $this->resultPg = $pagination->getResult();
        
        $list = new \Module\administrative\Models\helper\AdmsRead();
        $list->fullRead(
                "SELECT car.id,
                    car.nome,
                    car.imagem,
                    car.link,
                    car.ordem,
                    sit.nome nomeSit,
                    col.cor color
                FROM 
                    sts_carousels car
                INNER JOIN 
                    adms_situacao sit
                    ON sit.id = car.adms_situacoes_id
                INNER JOIN 
                    adms_cors col
                    ON col.id = sit.adms_cor_id
                ORDER BY car.ordem ASC
                LIMIT :limit
                OFFSET :offset",
                "limit={$this->limitResult}&offset={$pagination->getOffSet()}");
        $this->result = $list->getResult();
        return $this->result;
    }
}
