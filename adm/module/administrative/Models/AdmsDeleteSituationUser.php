<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsDeleteSituationUser
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsDeleteSituationUser
{
    private $dadoId;
    private $result;
    
    public function deleteSituationUser($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->checkRegisterSituationUser();
        if ($this->result) {
            $delete = new \Module\administrative\Models\helper\AdmsDelete();
            $delete->executeDelete("adms_situacao_users", "WHERE id =:id", "id={$this->dadoId}");
            if ($delete->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Situação"
                        . " usuário apagado.</div>";
                return $this->result = true;
            }
            $_SESSION['msg'] = "<div class='alert alert-danger'>Situação "
                    . "usuário não apagado.</div>";
            return $this->result = false;
        }
    }
    
    private function checkRegisterSituationUser()
    {
        $checkSitUser = new \Module\administrative\Models\helper\AdmsRead();
        $checkSitUser->fullRead(
                "SELECT id
                FROM adms_usuarios
                WHERE adms_situacao_user_id =:adms_situacao_user_id
                LIMIT :limit",
                "adms_situacao_user_id={$this->dadoId}&limit=2");
        if ($checkSitUser->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Situação usuário não
                    pode ser apagado, há usuários cadastradas nesta situação.</div>";
            return $this->result = false;
        }
        return $this->result = true;
    }
}
