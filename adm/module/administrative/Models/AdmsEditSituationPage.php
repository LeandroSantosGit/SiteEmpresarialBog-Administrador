<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsEditSituationPage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsEditSituationPage
{
    private $result;
    private $dados;
    private $dadoId;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function viewInfoSituationPage($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewSitPg = new \Module\administrative\Models\helper\AdmsRead();
        $viewSitPg->fullRead(
                "SELECT *
                FROM adms_situacao_paginas
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewSitPg->getResult();
        return $this->result;
    }
    
    public function alterSituationPage(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->updateEditSituationPage();
        }
        return $this->result = false;
    }
    
    private function updateEditSituationPage()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateSitPg = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateSitPg->exeUpdate(
                "adms_situacao_paginas",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dados['id']}"
        );
        if ($updateSitPg->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação "
                    . "de página atualizado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Situação de "
                . "página não atualizada, tente novamente.</div>";
        return $this->result = false;
    }
}
