<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of DeleteArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class DeleteArticle
{
    private $dadoId;
    
    public function removeArticle($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $deleteArticle = new \Module\site\Models\StsDeleteArticle();
            $deleteArticle->deleteArticle($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário "
                    . "selecionar um artigo.</div>";
        }
        $UrlDestino = URLADM . 'list-article/list-info-article';
        header("Location: $UrlDestino");
    }
}
