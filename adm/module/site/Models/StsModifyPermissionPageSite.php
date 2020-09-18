<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsModifyPermissionPageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsModifyPermissionPageSite
{
    private $dadoId;
    private $result;
    private $dados;
    private $dadosPage;
    
    function getResult()
    {
        return $this->result;
    }

    public function alterPageSiteMenuReleaseAndBlock($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->viewPageSite();
        if ($this->dadosPage) {
            return $this->updatePageSiteConditionMenu();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi 
                alterada a situação da página no menu do site.</div>";
        return $this->Resultado = false;
    }
    
    private function viewPageSite()
    {
        $viewPage = new \Module\administrative\Models\helper\AdmsRead();
        $viewPage->fullRead(
                "SELECT id, lib_bloqueado
                FROM sts_paginas
                WHERE id =:id",
                "id=$this->dadoId");
        $this->dadosPage = $viewPage->getResult();
    }
    
    private function updatePageSiteConditionMenu()
    {
        if ($this->dadosPage[0]['lib_bloqueado'] == 1) {
            $this->dados['lib_bloqueado'] = 2;
        } else {
            $this->dados['lib_bloqueado'] = 1;
        }
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateSitPage = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateSitPage->exeUpdate(
                "sts_paginas",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dadoId}"
        );
        if ($updateSitPage->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação da "
                    . "página no menu alterarda.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Situação da "
                . "página no menu não foi alterada, tente novamente.</div>";
        return $this->result = false;
    }
}
