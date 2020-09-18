<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsRegisterNewTypePage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsRegisterNewTypePage
{
    private $result;
    private $dados;
    private $lastTypePg;
    
    function getResult()
    {
        return $this->result;
    }

    public function registerTypePage(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->insertTypePage();
        }
        return $this->result = false;
    }
    
    private function insertTypePage()
    {
        $this->dados['created'] = date("Y-m-d H:i:s");
        $this->viewLastTypePage();
        $this->dados['ordem'] = $this->lastTypePg[0]['ordem'] + 1;
        $addTypePg = new \Module\administrative\Models\helper\AdmsCreate();
        $addTypePg->exeCreate("adms_tipos_paginas", $this->dados);
        if ($addTypePg->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Tipo de página cadastrado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Tipo de página não 
                cadastrado, tente novamente.</div>";
        return $this->result = false;
    }
    
    private function viewLastTypePage()
    {
        $viewTypePg = new \Module\administrative\Models\helper\AdmsRead();
        $viewTypePg->fullRead(
                "SELECT ordem
                FROM adms_tipos_paginas
                ORDER BY ordem DESC
                LIMIT :limit",
                "limit=1");
        $this->lastTypePg = $viewTypePg->getResult();
    }
}
