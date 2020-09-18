<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsEditTypePage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsEditTypePage
{
    private $result;
    private $dados;
    private $dadoId;
    
    function getResult()
    {
        return $this->result;
    }

    public function viewInfoTypePage($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewTypPg = new \Module\administrative\Models\helper\AdmsRead();
        $viewTypPg->fullRead(
                "SELECT *
                FROM adms_tipos_paginas
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewTypPg->getResult();
        return $this->result;
    }
    
    public function alterTypePage(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->updateEditTypePage();
        }
        return $this->result = false;
    }
    
    private function updateEditTypePage()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateTypPg = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateTypPg->exeUpdate(
                "adms_tipos_paginas",
                $this->dados,
                "WHERE id =:id",
                "id=" . $this->dados['id']
        );
        if ($updateTypPg->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Tipo de página "
                    . "foi atualizada.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Tipo de página"
                . " não foi atualizada.</div>";
        return $this->result = false;
    }
}
