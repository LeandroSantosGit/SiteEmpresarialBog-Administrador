<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsListArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsListArticle
{
    private $result;
    private $pageId;
    private $limitResult = 10;
    private $resultPg;
    
    function getResultPg()
    {
        return $this->resultPg;
    }

    public function listArticle($pageId = null)
    {
        $this->pageId = (int) $pageId;
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(
                URLADM . 'list-article/list-info-article');
        $pagination->condition($pageId, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) numResult FROM sts_artigos");
        $this->resultPg = $pagination->getResult();
        
        $listArticle = new \Module\administrative\Models\helper\AdmsRead();
        $listArticle->fullRead(
                "SELECT
                    art.id, art.titulo,
                    cat.nome nomeCat,
                    sit.nome nomeSit,
                    col.cor color
                FROM
                    sts_artigos art
                INNER JOIN
                    sts_cats_artigos cat
                    ON cat.id = art.sts_cats_artigo_id
                INNER JOIN
                    adms_situacao sit
                    ON sit.id = art.adms_sit_id
                INNER JOIN
                    adms_cors col
                    ON col.id = sit.adms_cor_id
                ORDER BY art.id DESC
                LIMIT :limit
                OFFSET :offset",
                "limit={$this->limitResult}&offset={$pagination->getOffSet()}");
        $this->result = $listArticle->getResult();
        return $this->result;
    }
}
