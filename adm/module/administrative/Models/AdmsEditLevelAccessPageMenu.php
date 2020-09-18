<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsEditLevelAccessPageMenu
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsEditLevelAccessPageMenu
{
    private $result;
    private $dados;
    private $dadoId;
    
    function getResult()
    {
        return $this->result;
    }
    
    /**
     * Ver página: receber o id da página para buscar informações do registro 
     * no banco de dados
     */
    public function levelAccessPage($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $accessPg = new \Module\administrative\Models\helper\AdmsRead();
        $accessPg->fullRead(
                "SELECT *
                FROM adms_niveis_acessos_paginas
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $accessPg->getResult();
        return $this->result;
    }
    
    /**
     * Editar página: receber array de dados com as informações da página
     */
    public function modifyMenu(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->updateEditMenu();
        }
        return $this->result = false;
    }
    
    /**
     * Editar página no banco: instancia a classe responsavél em editar no banco
     * Verificar status da ação, true ou false.
     */
    private function updateEditMenu()
    {
        $this->dados['modified'] = date("Y-m-d H:i");
        $updateAccess = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateAccess->exeUpdate(
                "adms_niveis_acessos_paginas",
                $this->dados,
                "WHERE id =:id", "id=" . $this->dados['id']
        );
        if ($updateAccess->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Item do menu
                    da página atualizado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Item do menu da
                página não atualizado, tente novamente.</div>";
        return $this->result = false;
    }
    
    /**
     * Listar registro para chave estrangeira: buscar informações nas tabelas
     * para utilizar como chave estrangeira.
     */
    public function listRegisterPage()
    {
        $list = new \Module\administrative\Models\helper\AdmsRead();
        $list->fullRead("SELECT id idMenu, nome nomeMenu FROM adms_menus ORDER BY nome ASC");
        $register['menu'] = $list->getResult();
        
        $this->result = ['menu' => $register['menu']];
        return $this->result;
    }
}
