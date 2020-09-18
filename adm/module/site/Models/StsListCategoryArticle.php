<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsListCategoryArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsListCategoryArticle
{
    private $result;
    private $pageId;
    private $limitResult = 10;
    private $resultPg;
    
    function getResultPg()
    {
        return $this->resultPg;
    }

    public function listCategoryArticle($pageId = null)
    {
        $this->pageId = (int) $pageId;
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(
                URLADM . 'list-category-article/list-info-category-article');
        $pagination->condition($this->pageId, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) numResult FROM sts_cats_artigos");
        $this->resultPg = $pagination->getResult();
        
        $listCatArticle = new \Module\administrative\Models\helper\AdmsRead();
        $listCatArticle->fullRead(
                "SELECT
                    cat.id, cat.nome,
                    sit.nome nomeSit,
                    col.cor color
                FROM
                    sts_cats_artigos cat
                INNER JOIN
                    adms_situacao sit
                    ON sit.id = cat.sts_situacoe_id
                INNER JOIN
                    adms_cors col
                    ON col.id = sit.adms_cor_id
                ORDER BY cat.id ASC
                LIMIT :limit
                OFFSET :offset",
                "limit={$this->limitResult}&offset={$pagination->getOffSet()}");
        $this->result = $listCatArticle->getResult();
        return $this->result;
    }
}
