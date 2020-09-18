<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsEditGroupPg
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsEditGroupPg
{
    private $result;
    private $dados;
    private $dadoId;
    
    function getResult()
    {
        return $this->result;
    }

    public function viewInfoGroupPage($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $groupPg = new \Module\administrative\Models\helper\AdmsRead();
        $groupPg->fullRead(
                "SELECT *
                FROM adms_grupos_paginas
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $groupPg->getResult();
        return $this->result;
    }
    
    public function alterGroupPage(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->updateEditGroupPage();
        }
        return $this->result = false;
    }
    
    private function updateEditGroupPage()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateGroupPg = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateGroupPg->exeUpdate(
                "adms_grupos_paginas",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dados['id']}"
        );
        if ($updateGroupPg->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Grupo da página atualizado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Grupo da página não 
                atualizado, tente novamente.</div>";
        return $this->result = false;
    }
}
