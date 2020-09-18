<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsModifySituationSobCompany
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsModifySituationSobCompany
{
    private $result;
    private $dadoId;
    private $dados;
    private $sobCompany;
    
    function getResult()
    {
        return $this->result;
    }

    public function alterSituationSobCompany($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->viewInfoSobCompany($this->dadoId);
        if ($this->sobCompany) {
            return $this->updateSobCompany();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi 
                alterado a situação do tópico sobre empresa.</div>";
        return $this->Resultado = false;
    }
    
    private function viewInfoSobCompany()
    {
        $viewInfoCompany = new \Module\administrative\Models\helper\AdmsRead();
        $viewInfoCompany->fullRead(
                "SELECT id, adms_sit_id
                FROM sts_sob_empresa
                WHERE id =:id",
                "id={$this->dadoId}");
        $this->sobCompany = $viewInfoCompany->getResult();
    }
    
    private function updateSobCompany()
    {
        if ($this->sobCompany[0]['adms_sit_id'] == 1) {
            $this->dados['adms_sit_id'] = 2;
        } else {
            $this->dados['adms_sit_id'] = 1;
        }
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updatesobCompany = new \Module\administrative\Models\helper\AdmsUpdate();
        $updatesobCompany->exeUpdate(
                "sts_sob_empresa",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dadoId}"
        );
        if ($updatesobCompany->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação do "
                    . "tópico sobre empresa alterarda.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Situação do tópico "
                . "sobre empresa não foi alterado, tente novamente.</div>";
        return $this->result = false;
    }
}
