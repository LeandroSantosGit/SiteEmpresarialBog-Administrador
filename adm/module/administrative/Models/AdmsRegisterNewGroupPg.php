<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsRegisterNewGroupPg
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsRegisterNewGroupPg
{
    private $result;
    private $dados;
    private $lastGroupPg;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function registerGroupPage(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->insertGroupPage();
        }
        return $this->result = false;
    }
    
    private function insertGroupPage()
    {
        $this->dados['created'] = date("Y-m-d H:i:s");
        $this->viewLastGroupPage();
        $this->dados['ordem'] = $this->lastGroupPg[0]['ordem'] + 1;
        $addGroupPg = new \Module\administrative\Models\helper\AdmsCreate();
        $addGroupPg->exeCreate("adms_grupos_paginas", $this->dados);
        if ($addGroupPg->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Grupo de páginas cadastrado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Grupo de páginas não 
                cadastrado, tente novamente.</div>";
        return $this->result = false;
    }
    
    private function viewLastGroupPage()
    {
        $viewGroupPg = new \Module\administrative\Models\helper\AdmsRead();
        $viewGroupPg->fullRead(
                "SELECT ordem
                FROM adms_grupos_paginas
                ORDER BY ordem DESC
                LIMIT :limit",
                "limit=1");
        $this->lastGroupPg = $viewGroupPg->getResult();
    }
}
