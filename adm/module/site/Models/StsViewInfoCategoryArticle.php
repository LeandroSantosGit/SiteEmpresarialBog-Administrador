<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsViewInfoCategoryArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsViewInfoCategoryArticle
{
    private $resuult;
    private $dadoId;
    
    public function viewCategoryArticle($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewCatArticle = new \Module\administrative\Models\helper\AdmsRead();
        $viewCatArticle->fullRead(
                "SELECT
                    cat.*,
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
                WHERE cat.id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->resuult = $viewCatArticle->getResult();
        return $this->resuult;
    }
}
