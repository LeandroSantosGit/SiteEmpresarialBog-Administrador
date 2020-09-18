<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsDeleteLevelAccess
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsDeleteLevelAccess
{
    private $dadoId;
    private $dados;
    private $result;
    private $dadoPrevious;
    
    function getResult()
    {
        return $this->result;
    }

    public function deleteAccess($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->viewUserRegister();
        if ($this->result) {
            $this->levelAcessUnder();
            $deleteAccess = new \Module\administrative\Models\helper\AdmsDelete();
            $deleteAccess->executeDelete("adms_niveis_acessos", "WHERE id =:id", "id={$this->dadoId}");
            if ($deleteAccess->getResult()) {
                $this->moveOrder();
                $this->deleteAccessPage();
                $_SESSION['msg'] = "<div class='alert alert-success'>Nível de acesso apagado.</div>";
                return $this->result = true;
            }
            $_SESSION['msg'] = "<div class='alert alert-danger'>Nível de acesso 
                    não foi apagado, tente novamente.</div>";
            return $this->result = false;
        }
    }
    
    private function viewUserRegister()
    {
        $viewUser = new \Module\administrative\Models\helper\AdmsRead();
        $viewUser->fullRead(
                "SELECT id
                FROM adms_usuarios
                WHERE adms_niveis_acesso_id =:adms_niveis_acesso_id
                LIMIT :limit",
                "adms_niveis_acesso_id=" . $this->dadoId . "&limit=2");
        if ($viewUser->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Nível de acesso
                    não pode ser apagado, possui usuários cadastrados.</div>";
            return $this->result = false;
        }
        return $this->result = true;
    }
    
    private function levelAcessUnder()
    {
        $accessOrder = new \Module\administrative\Models\helper\AdmsRead();
        $accessOrder->fullRead(
                "SELECT id, ordem AS ordemResult
                FROM adms_niveis_acessos
                WHERE ordem > (
                    SELECT ordem
                    FROM adms_niveis_acessos
                    WHERE id =:id)
                ORDER BY ordem ASC",
                "id={$this->dadoId}");
        $this->dadoPrevious = $accessOrder->getResult();
    }
    
    private function moveOrder()
    {
        if ($this->dadoPrevious) {
            foreach ($this->dadoPrevious as $currentOrder) {
                extract($currentOrder);
                $this->dados['ordem'] = $ordemResult - 1;
                $this->dados['modified'] = date("Y-m-d H:i");
                $updateAccess = new \Module\administrative\Models\helper\AdmsUpdate();
                $updateAccess->exeUpdate(
                        "adms_niveis_acessos",
                        $this->dados,
                        "WHERE id =:id", "id=" . $id
                );
            }
        }
    }
    
    private function deleteAccessPage()
    {
        $deleteAcPg = new \Module\administrative\Models\helper\AdmsDelete();
        $deleteAcPg->executeDelete(
                "adms_niveis_acessos_paginas",
                "WHERE adms_niveis_acesso_id =:adms_niveis_acesso_id",
                "adms_niveis_acesso_id={$this->dadoId}");
    }
}
