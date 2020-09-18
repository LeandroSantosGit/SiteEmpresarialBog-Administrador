<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location:");
    exit();
}

/**
 * Description of StsRegisterNewTypepgSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsRegisterNewTypepgSite
{
    private $result;
    private $dados;
    private $lastTypePage;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function registerTypePageSite(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->insertTypePageSite();
        }
        return $this->result = false;
    }
    
    private function insertTypePageSite()
    {
        $this->dados['created'] = date("Y-m-d H:i:s");
        $this->viewLastTypePage();
        $this->dados['ordem'] = $this->lastTypePage[0]['ordem'] + 1;
        $addTypePage = new \Module\administrative\Models\helper\AdmsCreate();
        $addTypePage->exeCreate("sts_tipos_paginas", $this->dados);
        if ($addTypePage->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Tipo de "
                    . "página do site cadastrado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-info'>Tipo de "
                    . "página do site não cadastrado.</div>";
        return $this->result = false;
    }
    
    private function viewLastTypePage()
    {
        $viewTypePage = new \Module\administrative\Models\helper\AdmsRead();
        $viewTypePage->fullRead(
                "SELECT ordem
                FROM sts_tipos_paginas
                ORDER BY ordem DESC
                LIMIT :limit",
                "limit=1");
        $this->lastTypePage = $viewTypePage->getResult();
    }
}
