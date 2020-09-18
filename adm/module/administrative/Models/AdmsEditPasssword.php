<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsEditPasssword
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsEditPasssword
{
    private $dados;
    private $dadosId;
    private $result;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function validateUser($dadoId)
    {
        $this->dadosId = (int) $dadoId;
        $validUser = new \Module\administrative\Models\helper\AdmsRead();
        $validUser->fullRead(
                "SELECT
                    user.id
                FROM
                    adms_usuarios user
                    INNER JOIN
                    adms_niveis_acessos nivac
                    ON nivac.id = user.adms_niveis_acesso_id
                WHERE
                    user.id =:id
                    AND nivac.ordem >:ordem
                LIMIT :limit",
                "id={$this->dadosId}&ordem=" . $_SESSION['userOrdemAcesso'] . "&limit=1");
        $this->dadosUser = $validUser->getResult();
        if (!empty($this->dadosUser)) {
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Usuário não encontrado.</div>";
        return $this->result = false;
    }
    
    public function editPassModel(array $dados)
    {
        $this->dados = $dados;
        $this->checkNewPassword();
    }
    
    /*private function validateInput()
    {
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->result = true;
        }
        return $this->result = false;
    }*/
    
    /* validar caracteres da senha */
    private function checkNewPassword() {
        $validPass = new \Module\administrative\Models\helper\AdmsValidatePassword();
        $validPass->validatePassword($this->dados['senha']);
        if ($validPass->getResult()) {
            return $this->updateEditNewPass();
        }
        return $this->result = false;
    }
    
    private function updateEditNewPass()
    {
        $this->validateUser($this->dados['id']);
        if ($this->result) {
            $this->dados['senha'] = password_hash($this->dados['senha'], PASSWORD_DEFAULT);
            $this->dados['modified'] = date("Y-m-d H:i:s");
            $updateNewPass = new \Module\administrative\Models\helper\AdmsUpdate();
            $updateNewPass->exeUpdate(
                    "adms_usuarios",
                    $this->dados, 
                    "WHERE id =:id",
                    "id={$this->dados['id']}"
            );
            if ($updateNewPass->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-primary'>Sua senha foi atualizada.</div>";
                return $this->result = true;
            }
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro, senha não atualizada.</div>";
            return $this->result = false;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Erro, senha não atualizada.</div>";
        return $this->result = false;
    }
}
