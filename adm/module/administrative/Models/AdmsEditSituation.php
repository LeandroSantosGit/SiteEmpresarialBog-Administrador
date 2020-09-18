<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsEditSituation
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsEditSituation
{
    private $result;
    private $dados;
    private $dadoId;
    
    function getResult()
    {
        return $this->result;
    }

    public function viewInfoSituation($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewSituation = new \Module\administrative\Models\helper\AdmsRead();
        $viewSituation->fullRead(
                "SELECT *
                FROM adms_situacao
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewSituation->getResult();
        return $this->result;
    }
    
    public function alterSituation(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->updateEditSituation();
        }
        return $this->result = false;
    }
    
    private function updateEditSituation()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateSituation = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateSituation->exeUpdate(
                "adms_situacao",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dados['id']}"
        );
        if ($updateSituation->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação atualizado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Situação não 
                atualizada, tente novamente.</div>";
        return $this->result = false;
    }
    
    public function listSituation()
    {
        $list = new \Module\administrative\Models\helper\AdmsRead();
        $list->fullRead("SELECT id idCor, nome nomeCor FROM adms_cors ORDER BY nome ASC");
        $register['color'] = $list->getResult();
        $this->result = ['color' => $register['color']];
        return $this->result;
    }
}
