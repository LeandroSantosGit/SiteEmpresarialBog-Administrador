<?php

namespace Module\administrative\Models;

if (!defined("URL")) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsUpdatePassword
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsUpdatePassword
{
    private $key;
    private $dadosUser;
    private $result;
    private $dados;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function validateKey($key)
    {
        $this->key = (string) $key;
        $validKey = new \Module\administrative\Models\helper\AdmsRead();
        $validKey->fullRead(
                "SELECT
                    id
                FROM
                    adms_usuarios
                WHERE
                    recuperar_senha =:recuperar_senha",
                "recuperar_senha={$this->key}");
        $this->dadosUser = $validKey->getResult();
        
        if (!empty($this->dadosUser)) {
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-primary'>Erro, link invalido.</div>";
        return $this->result = false;
    }
    
    public function updatePassModel(array $dados)
    {
        $this->dados = $dados;
        $this->validateInputNewPass();
    }
    
    private function validateInputNewPass()
    {
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->checkNewPassword();
        }
        return $this->result = false;
    }
    
    /* validar caracteres da senha */
    private function checkNewPassword() {
        $validPass = new \Module\administrative\Models\helper\AdmsValidatePassword();
        $validPass->validatePassword($this->dados['senha']);
        if ($validPass->getResult()) {
            return $this->newPasswordUser();
        }
        return $this->result = false;
    }
    
    private function newPasswordUser()
    {
        $this->validateKey($this->dados['recuperar_senha']);
        $this->dados['recuperar_senha'] = NULL;
        $this->dados['senha'] = password_hash($this->dados['senha'], PASSWORD_DEFAULT);
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateNewPass = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateNewPass->exeUpdate("adms_usuarios", $this->dados, 
                "WHERE id =:id", "id={$this->dadosUser[0]['id']}");
        if ($updateNewPass->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-primary'>Sua senha foi atualizada.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Erro, senha não atualizada.</div>";
        return $this->result = false;
    }
}
