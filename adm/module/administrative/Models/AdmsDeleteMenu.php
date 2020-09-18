<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsDeleteMenu
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsDeleteMenu
{
    private $dadoId;
    private $result;
    private $dados;
    private $dadoUnder;
    
    function getResult()
    {
        return $this->result;
    }

    public function deleteItemMenu($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->checkRegisterItemMenu();
        if ($this->result) {
            $this->checkBottomItemMenu();
            $delete = new \Module\administrative\Models\helper\AdmsDelete();
            $delete->executeDelete("adms_menus", "WHERE id =:id", "id={$this->dadoId}");
            if ($delete->getResult()) {
                $this->moveOrder();
                $_SESSION['msg'] = "<div class='alert alert-success'>Item do menu apagado.</div>";
                return $this->result = true;
            }
            return $this->result = false;
        }
    }
    
    private function checkRegisterItemMenu()
    {
        $checkPermssion = new \Module\administrative\Models\helper\AdmsRead();
        $checkPermssion->fullRead(
                "SELECT id
                FROM adms_niveis_acessos_paginas
                WHERE adms_menu_id =:adms_menu_id
                LIMIT :limit",
                "adms_menu_id={$this->dadoId}&limit=2");
        if ($checkPermssion->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Item do menu não
                    pode ser apagado, há permissões cadastradas neste item do menu.</div>";
            return $this->result = false;
        }
        return $this->result = true;
    }

    private function checkBottomItemMenu()
    {
        $itemMenu = new \Module\administrative\Models\helper\AdmsRead();
        $itemMenu->fullRead(
                "SELECT id, ordem ordemResult
                FROM adms_menus
                WHERE ordem > (
                        SELECT ordem
                        FROM adms_menus
                        WHERE id =:id)
                ORDER BY ordem ASC",
                "id={$this->dadoId}");
        $this->dadoUnder = $itemMenu->getResult();
    }
    
    private function moveOrder()
    {
        if ($this->dadoUnder) {
            foreach ($this->dadoUnder as $currentOrder) {
                extract($currentOrder);
                $this->dados['ordem'] = $ordemResult - 1;
                $this->dados['modified'] = date("Y-m-d H:i");
                $updateAccess = new \Module\administrative\Models\helper\AdmsUpdate();
                $updateAccess->exeUpdate(
                        "adms_menus",
                        $this->dados,
                        "WHERE id =:id",
                        "id=" . $id
                );
            }
        }
    }
}
