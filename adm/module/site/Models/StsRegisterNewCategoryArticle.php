<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsRegisterNewCategoryArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsRegisterNewCategoryArticle
{
    private $result;
    private $dados;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function registerCategoryArticle(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->insertNewCategoryArticle();
        }
        return $this->result = false;
    }
    
    private function insertNewCategoryArticle()
    {
        $this->dados['created'] = date("Y-m-d H:i:s");
        $addCatArticle = new \Module\administrative\Models\helper\AdmsCreate();
        $addCatArticle->exeCreate("sts_cats_artigos", $this->dados);
        if ($addCatArticle->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Categoria "
                . "de artigo cadastro.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Categoria "
                . "de artigo não cadastro.</div>";
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
