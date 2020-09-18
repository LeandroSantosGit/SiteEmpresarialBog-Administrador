<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsModifyPassword
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsModifyPassword
{
    private $result;
    private $dados;
    
    function getResult()
    {
        return $this->result;
    }

    public function AdmsModifyPassUser(array $dados)
    {
        $this->dados = $dados;
        $this->validatePassword();
    }
    
    private function validatePassword()
    {
        $validePassword = new \Module\administrative\Models\helper\AdmsValidatePassword();
        $validePassword->validatePassword($this->dados['senha']);
        if ($validePassword->getResult()) {
            return $this->updateModifyPass();
        }
        return $this->result = false;
    }

    private function updateModifyPass()
    {
        $this->dados['senha'] = password_hash($this->dados['senha'], PASSWORD_DEFAULT);
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updatePass = new \Module\administrative\Models\helper\AdmsUpdate();
        $updatePass->exeUpdate("adms_usuarios", $this->dados, "WHERE id =:id", "id=" . $_SESSION['userId']);
        if ($updatePass->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-primary'>Sua senha foi atualizada.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Erro, senha não atualizada.</div>";
        return $this->result = false;
    }
}
