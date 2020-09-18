<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsModifyOrderItemMenu
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsModifyOrderItemMenu
{
    private $dadoId;
    private $result;
    private $dados;
    private $dadosMenu;
    private $dadoMenuUnder;
    
    function getResult()
    {
        return $this->result;
    }

    public function moveOrderItemMenu($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->viewInfoMenu($this->dadoId);
        if ($this->dadosMenu) {
            $this->itemMenuBottom();
            if ($this->dadoMenuUnder) {
                $this->moveItemMenu();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi 
                        alterado a ordem do item no menu</div>";
                $this->Resultado = false;
            }
        }
    }
    
    private function viewInfoMenu()
    {
        $itemMenu = new \Module\administrative\Models\helper\AdmsRead();
        $itemMenu->fullRead(
                "SELECT *
                FROM adms_menus
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->dadosMenu = $itemMenu->getResult();
    }
    
    private function itemMenuBottom()
    {
        $orderSuper = $this->dadosMenu[0]['ordem'] - 1;
        $viewMenu = new \Module\administrative\Models\helper\AdmsRead();
        $viewMenu->fullRead(
                "SELECT id, ordem
                FROM adms_menus
                WHERE ordem =:ordem",
                "ordem={$orderSuper}");
        $this->dadoMenuUnder = $viewMenu->getResult();
    }

    private function moveItemMenu()
    {
        $this->dados['ordem'] = $this->dadosMenu[0]['ordem'];
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $moveDown = new \Module\administrative\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate(
                "adms_menus",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dadoMenuUnder[0]['id']}"
        );
        $this->dados['ordem'] = $this->dadosMenu[0]['ordem'] - 1;
        $moveUp = new \Module\administrative\Models\helper\AdmsUpdate();
        $moveUp->exeUpdate(
                "adms_menus",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dadosMenu[0]['id']}"
        );
        if ($moveUp->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Ordem de item do menu alterarda.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Ordem de item do menu
                não foi alterada, tente novamente.</div>";
        return $this->result = false;
    }
}
