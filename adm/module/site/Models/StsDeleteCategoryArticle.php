<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsDeleteCategoryArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsDeleteCategoryArticle
{
    private $dadoId;
    private $result;
    
    public function deleteCategoryArticle($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->checkRegisterCategoryArticle();
        if ($this->result) {
            $deleteCatArticle = new \Module\administrative\Models\helper\AdmsDelete();
            $deleteCatArticle->executeDelete(
                    "sts_cats_artigos",
                    "WHERE id =:id",
                    "id={$this->dadoId}"
            );
            if ($deleteCatArticle->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Categoria de "
                        . "artigo apagado.</div>";
                return $this->result = true;
            }
            $_SESSION['msg'] = "<div class='alert alert-danger'>Categoria de "
                    . "artigo não apagado.</div>";
            return $this->result = false;
        }
    }
    
    private function checkRegisterCategoryArticle()
    {
        $viewCatArticle = new \Module\administrative\Models\helper\AdmsRead();
        $viewCatArticle->fullRead(
                "SELECT id
                FROM sts_artigos
                WHERE sts_cats_artigo_id =:sts_cats_artigo_id
                LIMIT :limit",
                "sts_cats_artigo_id={$this->dadoId}&limit=2");
        if ($viewCatArticle->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Categoria de "
                . "artigo não pode ser apagado, há artigo cadastrado nesta categoria.</div>";
            return $this->result = false;
        }
        return $this->result = true;
    }
}
