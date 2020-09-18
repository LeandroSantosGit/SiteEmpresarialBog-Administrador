<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsRegisterLevelAccess
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsRegisterLevelAccess
{
    private $result;
    private $dados;
    private $lastLevelAccess;
    
    function getResult()
    {
        return $this->result;
    }

    public function addLevelAccess(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->insertLevelAccess();
        }
        return $this->result = false;
    }
    
    private function insertLevelAccess()
    {
        $this->dados['created'] = date("Y-m-d H:i");
        $this->viewLastAccess();
        $this->dados['ordem'] = $this->lastLevelAccess[0]['ordem'] + 1;
        $registerAcess = new \Module\administrative\Models\helper\AdmsCreate();
        $registerAcess->exeCreate("adms_niveis_acessos", $this->dados);
        if ($registerAcess->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Nível de acesso cadastrado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Nível de acesso 
                não cadastrado, tente novamente.</div>";
        return $this->result = false;
    }
    
    private function viewLastAccess()
    {
        $levelAcsess = new \Module\administrative\Models\helper\AdmsRead();
        $levelAcsess->fullRead(
                "SELECT ordem
                FROM adms_niveis_acessos
                ORDER BY ordem DESC
                LIMIT :limit",
                "limit=1");
        $this->lastLevelAccess = $levelAcsess->getResult();
    }
}
