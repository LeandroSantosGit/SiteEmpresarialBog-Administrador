<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsEditCategoryArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsEditCategoryArticle
{
    private $dadoId;
    private $dados;
    private $result;
    
    function getResult()
    {
        return $this->result;
    }

    public function viewInfoCategoryArticle($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewCatArticle = new \Module\administrative\Models\helper\AdmsRead();
        $viewCatArticle->fullRead(
                "SELECT *
                FROM sts_cats_artigos
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewCatArticle->getResult();
        return $this->result;
    }
    
    public function alterCategoryArticle(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->updateCategoryArticle();
        }
        return $this->result = false;
    }
    
    private function updateCategoryArticle()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateCatArticle = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateCatArticle->exeUpdate(
                "sts_cats_artigos",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dados['id']}"
        );
        if ($updateCatArticle->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Categoria de "
                    . "artigo atualizado</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Categoria de "
                    . "artigo não atualizado</div>";
        return $this->result = false;
    }
    
    public function listCategoryArticle()
    {
        $list = new \Module\administrative\Models\helper\AdmsRead();
        $list->fullRead("SELECT id idSit, nome nomeSit FROM adms_situacao ORDER BY nome ASC");
        $register['sit'] = $list->getResult();
        
        $this->result = ['sit' => $register['sit']];
        return $this->result;
    }
}
