<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsRegisterNewSituation
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsRegisterNewSituation
{
    private $result;
    private $dados;
    
    function getResult()
    {
        return $this->result;
    }

    public function registerSituation(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->insertSituation();
        }
        return $this->result = false;
    }
    
    private function insertSituation()
    {
        $this->dados['created'] = date("Y-m-d H:i:s");
        $addSituation = new \Module\administrative\Models\helper\AdmsCreate();
        $addSituation->exeCreate("adms_situacao", $this->dados);
        if ($addSituation->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação cadastrada.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Situação não 
                cadastrada, tente novamente.</div>";
        return $this->result = false;
    }
    
    public function listSituation()
    {
        $list = new \Module\administrative\Models\helper\AdmsRead();
        $list->fullRead(
                "SELECT id idCor, nome nomeCor FROM adms_cors ORDER BY nome ASC");
        $register['color'] = $list->getResult();
        $this->result = ['color' => $register['color']];
        return $this->result;
    }
}
