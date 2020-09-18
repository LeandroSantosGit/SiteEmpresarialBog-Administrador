<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsRegisterNewSitpageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsRegisterNewSitpageSite
{
    private $result;
    private $dados;
    
    function getResult()
    {
        return $this->result;
    }

    public function registerSituationPageSite(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->insertSituationPageSite();
        }
        return $this->result = false;
    }
    
    private function insertSituationPageSite()
    {
        $this->dados['created'] = date("Y-m-d H:i:s");
        $addSituationPage = new \Module\administrative\Models\helper\AdmsCreate();
        $addSituationPage->exeCreate("sts_situacaos_pgs", $this->dados);
        if ($addSituationPage->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação de "
                    . "página do site cadastrada.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-info'>Situação de "
                    . "página do site não cadastrada.</div>";
        return $this->result = false;
    }
    
    public function listSituationPageSite()
    {
        $list = new \Module\administrative\Models\helper\AdmsRead();
        $list->fullRead("SELECT id idColor, nome nomeColor FROM adms_cors ORDER BY nome ASC");
        $register['color'] = $list->getResult();
        
        $this->result = ['color' => $register['color']];
        return $this->result;
    }
}
