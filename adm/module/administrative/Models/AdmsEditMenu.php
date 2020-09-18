<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsEditMenu
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsEditMenu
{
    private $result;
    private $dados;
    private $dadoId;
    
    function getResult()
    {
        return $this->result;
    }
    
    /**
     * Ver iterm menu: receber o id do iterm menu para buscar informações
     * do registro no banco de dados
     */
    public function viewInfoMenu($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $itemMenu = new \Module\administrative\Models\helper\AdmsRead();
        $itemMenu->fullRead(
                "SELECT *
                FROM adms_menus
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $itemMenu->getResult();
        return $this->result;
    }
    
    /**
     * Editar item menu: receber array de dados com as informações do item menu
     */
    public function alterMenu(array $dados)
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
     * Editar item menu no banco: instancia a classe responsavél em editar no banco
     * Verificar status da ação, true ou false.
     */
    private function updateEditMenu()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateMenu = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateMenu->exeUpdate(
                "adms_menus",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dados['id']}"
        );
        if ($updateMenu->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Item do menu atualizado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Item do menu não 
                atualizado, tente novamente.</div>";
        return $this->result = false;
    }
    
    /**
     * Listar registro para chave estrangeira: buscar informações nas tabelas
     * para utilizar como chave estrangeira.
     */
    public function listRegisterMenu()
    {
        $list = new \Module\administrative\Models\helper\AdmsRead();
        $list->fullRead("SELECT id idSit, nome nomeSit FROM adms_situacao ORDER BY nome ASC");
        $register['sitMenu'] = $list->getResult();
        
        $this->result = ['sitMenu' => $register['sitMenu']];
        return $this->result;
    }
}
