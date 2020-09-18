<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsRegisterNewTypeArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsRegisterNewTypeArticle
{
    private $result;
    private $dados;
    
    function getResult()
    {
        return $this->result;
    }

    public function registerTypeArticle(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->insertNewTypeArticle();
        }
        return $this->result = false;
    }
    
    private function insertNewTypeArticle()
    {
        $this->dados['created'] = date("Y-m-d H:i:s");
        $addTypeArticle = new \Module\administrative\Models\helper\AdmsCreate();
        $addTypeArticle->exeCreate("sts_tps_artigos", $this->dados);
        if ($addTypeArticle->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Tipo de artigo cadastro.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Tipo de artigo não cadastro.</div>";
        return $this->result = false;
    }
}
