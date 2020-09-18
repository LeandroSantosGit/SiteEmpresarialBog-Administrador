<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsEditSitpageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsEditSitpageSite
{
    private $result;
    private $dados;
    private $dadoId;
    
    function getResult()
    {
        return $this->result;
    }

    public function viewSituationPageSite($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $situationPage = new \Module\administrative\Models\helper\AdmsRead();
        $situationPage->fullRead(
                "SELECT *
                FROM sts_situacaos_pgs
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $situationPage->getResult();
        return $this->result;
    }
    
    public function alterSituationPageSite(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->updateEditSituationPageSite();
        }
        return $this->result = false;
    }
    
    private function updateEditSituationPageSite()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateSitPage = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateSitPage->exeUpdate(
                "sts_situacaos_pgs",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dados['id']}"
        );
        if ($updateSitPage->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação "
                    . "de página do site atualizado</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Situação "
                    . "de página do site não atualizado</div>";
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
