<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsConfigSendEmail
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsConfigSendEmail
{
    private $result;
    private $dados;
    
    function getResult()
    {
        return $this->result;
    }

    public function configEmail()
    {
        $infoEmail = new \Module\administrative\Models\helper\AdmsRead();
        $infoEmail->fullRead(
                "SELECT *
                FROM amds_configuracao_email
                WHERE id =:id
                LIMIT :limit",
                "id=1&limit=1");
        $this->result = $infoEmail->getResult();
        return $this->result;
    }
    
    public function alterConfigEmail(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        $validEmail = new \Module\administrative\Models\helper\AdmsValidateEmail();
        $validEmail->validateEmail($this->dados['email']);
        if ($validInput->getResult() && $validEmail->getResult()) {
            return $this->updateConfigEmail();
        }
        return $this->result = false;
    }
    
    private function updateConfigEmail()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $update = new \Module\administrative\Models\helper\AdmsUpdate();
        $update->exeUpdate(
                "amds_configuracao_email",
                $this->dados,
                "WHERE id =:id",
                "id=1"
        );
        if ($update->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Configuração 
                    de envio de email alterada.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Configuração de 
                envio de email não alterada, tente novamente.</div>";
        return $this->result = false;
    }
}
