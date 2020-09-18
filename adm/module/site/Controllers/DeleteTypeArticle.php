<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of DeleteTypeArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class DeleteTypeArticle
{
    private $dadoId;
    
    public function removeTypeArticle($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $deleteTpArticle = new \Module\site\Models\StsDeleteTypeArticle();
            $deleteTpArticle->deleteTypeArticle($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário "
                    . "selecionar um tipo de artigo.</div>";
        }
        $UrlDestino = URLADM . 'list-type-article/list-info-type-article';
        header("Location: $UrlDestino");
    }
}
