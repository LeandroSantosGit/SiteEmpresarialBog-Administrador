<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsEditLevelAccess
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsEditLevelAccess
{
    private $result;
    private $dados;
    private $dadoId;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function viewInfoAccess($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewAccess = new \Module\administrative\Models\helper\AdmsRead();
        $viewAccess->fullRead(
                "SELECT *
                FROM adms_niveis_acessos
                WHERE id =:id AND ordem >=:ordem
                LIMIT :limit",
                "id={$this->dadoId}&ordem=" . $_SESSION['userOrdemAcesso'] . "&limit=1");
        $this->result = $viewAccess->getResult();
        return $this->result;
    }
    
    public function AdmsEditAccess(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->updateEditAccess();
        }
        return $this->result = false;
    }
    
    private function updateEditAccess()
    {
        $this->dados['modified'] = date("Y-m-d H:i");
        $updateAccess = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateAccess->exeUpdate(
                "adms_niveis_acessos",
                $this->dados,
                "WHERE id =:id", "id=" . $this->dados['id']
        );
        if ($updateAccess->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Nível de acesso atualizado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Nível de acesso não 
                atualizado, tente novamente.</div>";
        return $this->result = false;
    }
}
