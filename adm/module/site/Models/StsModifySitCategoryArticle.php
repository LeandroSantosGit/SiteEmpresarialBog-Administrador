<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsModifySitCategoryArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsModifySitCategoryArticle
{
    private $dadoId;
    private $result;
    private $dados;
    private $categoryArticle;
    
    public function alterSituationCategoryArticle($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->viewInfoCategoryArticle();
        if ($this->categoryArticle) {
            return $this->alterCategoryArticle();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi 
                alterado a situação da categoria de artigo.</div>";
        return $this->Resultado = false;
    }
    
    private function viewInfoCategoryArticle()
    {
        $viewCatArticle = new \Module\administrative\Models\helper\AdmsRead();
        $viewCatArticle->fullRead(
                "SELECT id, sts_situacoe_id
                FROM sts_cats_artigos
                WHERE id =:id",
                "id={$this->dadoId}");
        $this->categoryArticle = $viewCatArticle->getResult();
    }
    
    private function alterCategoryArticle()
    {
        if ($this->categoryArticle[0]['sts_situacoe_id'] == 1) {
            $this->dados['sts_situacoe_id'] = 2;
        } else {
            $this->dados['sts_situacoe_id'] = 1;
        }
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateCarousel = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateCarousel->exeUpdate(
                "sts_cats_artigos",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dadoId}"
        );
        if ($updateCarousel->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação da "
                    . "categoria de artigo alterarda.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Situação da "
                . "categoria de artigo não foi alterada, tente novamente.</div>";
        return $this->result = false;
    }
}
