<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ModifySitCategoryArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ModifySitCategoryArticle
{
    private $dadoId;
    
    public function alterSitCategoryArticle($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $alterSitCatArticle = new \Module\site\Models\StsModifySitCategoryArticle();
            $alterSitCatArticle->alterSituationCategoryArticle($this->dadoId);
        }
        $urlRedirect = URLADM . 'list-category-article/list-info-category-article';
        return header("Location: $urlRedirect");
    }
}
