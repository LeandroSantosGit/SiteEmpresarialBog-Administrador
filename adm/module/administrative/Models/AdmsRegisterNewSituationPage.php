<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsRegisterNewSituationPage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsRegisterNewSituationPage
{
    private $result;
    private $dados;
    
    function getResult()
    {
        return $this->result;
    }

    public function registerSituationPage(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->insertSituationPage();
        }
        return $this->result = false;
    }
    
    public function insertSituationPage()
    {
        $this->dados['created'] = date("Y-m-d H:i:s");
        $addSitPg = new \Module\administrative\Models\helper\AdmsCreate();
        $addSitPg->exeCreate("adms_situacao_paginas", $this->dados);
        if ($addSitPg->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação de "
                    . "página cadastrada.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Situação de "
                . "página não cadastrada, tente novamente.</div>";
        return $this->result = false;
    }
}
