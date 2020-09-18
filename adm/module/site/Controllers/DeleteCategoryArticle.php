<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of DeleteCategoryArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class DeleteCategoryArticle
{
    private $dadoId;
    
    public function removeCategoryArticle($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $deleteCatArticle = new \Module\site\Models\StsDeleteCategoryArticle();
            $deleteCatArticle->deleteCategoryArticle($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário "
                    . "selecionar uma categoria de artigo.</div>";
        }
        $UrlDestino = URLADM . 'list-category-article/list-info-category-article';
        header("Location: $UrlDestino");
    }
}
