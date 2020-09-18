<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsEditTypepgSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsEditTypepgSite
{
    private $result;
    private $dados;
    private $dadoId;
    
    function getResult()
    {
        return $this->result;
    }

    public function viewTypePageSite($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewTypePg = new \Module\administrative\Models\helper\AdmsRead();
        $viewTypePg->fullRead(
                "SELECT *
                FROM sts_tipos_paginas
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewTypePg->getResult();
        return $this->result;
    }
    
    public function alterTypePageSite(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->updateTypePage();
        }
        return $this->result = false;
    }
    
    private function updateTypePage()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateTypePg = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateTypePg->exeUpdate(
                "sts_tipos_paginas",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dados['id']}"
        );
        if ($updateTypePg->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Tipo de "
                    . "página atualizado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Tipo de "
                    . "página não atualizado.</div>";
        return $this->result = false;
    }
}
