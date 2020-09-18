<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsConfirmEmail
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsConfirmEmail
{
    private $valueKey;
    private $dadosUser;
    private $result;
    private $dados;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function confirmEmailUser($key)
    {
        $this->valueKey = (string) $key;
        $validateKey = new \Module\administrative\Models\helper\AdmsRead();
        $validateKey->fullRead(
                "SELECT
                  id
                FROM
                    adms_usuarios
                WHERE
                    config_email =:config_email
                LIMIT 
                    :limit",
                "config_email={$this->valueKey}&limit=1");
        $this->dadosUser = $validateKey->getResult();
        
        if (!empty($this->dadosUser)) {
            $this->updateConfirmEmail();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Link de confimação invalido</div>";
            $this->result = false;
        }
    }
    
    private function updateConfirmEmail()
    {
        $this->dados['config_email'] = NULL;
        $this->dados['adms_situacao_user_id'] = 1;
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateConfEmail = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateConfEmail->exeUpdate("adms_usuarios",$this->dados, "WHERE id =:id", "id={$this->dadosUser[0]['id']}");
        if ($updateConfEmail->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Email confirmado, seja bem vindo</div>";
            $this->result = true;
        } else {
            $this->result = false;
        }
    }
}
