<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsEditSituationUser
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsEditSituationUser
{
    private $result;
    private $dados;
    private $dadoId;
    
    function getResult()
    {
        return $this->result;
    }

    public function viewInfoSituationUser($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewSitUser = new \Module\administrative\Models\helper\AdmsRead();
        $viewSitUser->fullRead(
                "SELECT *
                FROM adms_situacao_users
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewSitUser->getResult();
        return $this->result;
    }
    
    public function alterSituationUser(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->updateSituationUser();
        }
        return $this->result = false;
    }
    
    private function updateSituationUser()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateSitUser = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateSitUser->exeUpdate(
                "adms_situacao_users",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dados['id']}"
        );
        if ($updateSitUser->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação usuário atualizado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Situação usuário não 
                atualizada, tente novamente.</div>";
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
