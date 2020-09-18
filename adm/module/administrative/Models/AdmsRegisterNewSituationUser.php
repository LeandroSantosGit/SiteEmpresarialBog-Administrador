<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsRegisterNewSituationUser
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsRegisterNewSituationUser
{
    private $result;
    private $dados;
    
    function getResult()
    {
        return $this->result;
    }

    public function registerSituationUser(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->insertSituationUser();
        }
        return $this->result = false;
    }
    
    private function insertSituationUser()
    {
        $this->dados['created'] = date("Y-m-d H:i:s");
        $addSitUser = new \Module\administrative\Models\helper\AdmsCreate();
        $addSitUser->exeCreate("adms_situacao_users", $this->dados);
        if ($addSitUser->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação "
                    . "usuário cadastrada.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Situação usuário não 
                cadastrada, tente novamente.</div>";
        return $this->result = false;
    }
    
    public function listSituationUser()
    {
        $list = new \Module\administrative\Models\helper\AdmsRead();
        $list->fullRead("SELECT id idCor, nome nomeCor FROM adms_cors ORDER BY nome ASC");
        $register['color'] = $list->getResult();
        $this->result = ['color' => $register['color']];
        return $this->result;
    }
}
