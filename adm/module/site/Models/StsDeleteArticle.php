<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsDeleteArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsDeleteArticle
{
    private $dadoId;
    private $result;
    private $dadosArticle;
    
    function getResult()
    {
        return $this->result;
    }

    public function deleteArticle($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->viewInfoArticle();
        if ($this->dadosArticle) {
            $deleteArticle = new \Module\administrative\Models\helper\AdmsDelete();
            $deleteArticle->executeDelete(
                    "sts_artigos",
                    "WHERE id =:id",
                    "id={$this->dadoId}"
            );
            if ($deleteArticle->getResult()) {
                $this->deleteImgageArticle();
                $_SESSION['msg'] = "<div class='alert alert-success'>Artigo "
                        . "apagado.</div>";
                return $this->result = true;
            }
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Artigo "
                . "não apagado.</div>";
       return $this->result = false;
    }
    
    private function deleteImgageArticle()
    {
        $deleteImg = new \Module\administrative\Models\helper\AdmsDeleteImg();
        $deleteImg->deleteImage(
                '../site/assets/images/article/'
                    . $this->dadoId
                    . '/'
                    . $this->dadosArticle[0]['imagem'],
                '../site/assets/images/article/' . $this->dadoId
        );
    }
    
    private function viewInfoArticle()
    {
        $viewArticle = new \Module\administrative\Models\helper\AdmsRead();
        $viewArticle->fullRead(
                "SELECT imagem
                FROM sts_artigos
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->dadosArticle = $viewArticle->getResult();
    }
}
