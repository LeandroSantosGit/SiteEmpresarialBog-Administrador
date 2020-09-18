<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsRegisterNewMenu
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsRegisterNewMenu
{
    private $result;
    private $dados;
    private $lastMenu;
    
    function getResult()
    {
        return $this->result;
    }

    public function registerMenu(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->insertMenu();
        }
        return $this->result = false;
    }
    
    private function insertMenu()
    {
        $this->dados['created'] = date("Y-m-d H:i:s");
        $this->viewLastMenu();
        $this->dados['ordem'] = $this->lastMenu[0]['ordem'] + 1;
        $addMenu = new \Module\administrative\Models\helper\AdmsCreate();
        $addMenu->exeCreate("adms_menus", $this->dados);
        if ($addMenu->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Item de menu cadastrado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Item de menu não 
                cadastrado, tente novamente.</div>";
        return $this->result = false;
    }
    
    private function viewLastMenu()
    {
        $viewMenu = new \Module\administrative\Models\helper\AdmsRead();
        $viewMenu->fullRead(
                "SELECT ordem FROM adms_menus ORDER BY ordem DESC LIMIT :limit", "limit=1");
        $this->lastMenu = $viewMenu->getResult();
    }
    
    public function listRegisterItemMenu()
    {
        $list = new \Module\administrative\Models\helper\AdmsRead();
        $list->fullRead("SELECT id idSit, nome nomeSit FROM adms_situacao ORDER BY nome ASC");
        $register['sit'] = $list->getResult();
        $this->result = ['sit' => $register['sit']];
        return $this->result;
    }
}
