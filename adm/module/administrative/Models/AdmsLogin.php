<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit(); 
}

/**
 * Description of AdmsLogin
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsLogin
{
    private $dados;
    private $result;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function accessLogin(array $dados)
    {
        $this->dados = $dados;
        $this->validateInput();
        $this->listUserDb();
    }
    
    /** Validar campos de input login */
    private function validateInput()
    {
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->result = true;
        }
        return $this->result = false;
    }

    /* buscar dados de usuario no db */
    private function listUserDb()
    {
        if ($this->result) {
            $listLoginUser = new \Module\administrative\Models\helper\AdmsRead();
            $listLoginUser->fullRead(
                "SELECT
                    user.id, user.nome, user.email, user.usuario, user.senha,
                    user.imagem, user.adms_niveis_acesso_id, nivac.ordem ornic
                FROM
                    adms_usuarios user
                INNER JOIN
                    adms_niveis_acessos nivac
                    ON nivac.id = user.adms_niveis_acesso_id
                WHERE
                    user.usuario =:usuario
                LIMIT
                    :limit", 
                "usuario={$this->dados['user']}&limit=1");
            $this->result = $listLoginUser->getResult();
            $this->acceptLogin();
        }
    }

    /* checkar a senha do usuario */
    private function validatePassword()
    {
        if (password_verify($this->dados['password'], $this->result[0]['senha'])) {
            $_SESSION['userId'] = $this->result[0]['id'];
            $_SESSION['userName'] = $this->result[0]['nome'];
            $_SESSION['userEmail'] = $this->result[0]['email'];
            $_SESSION['userImage'] = $this->result[0]['imagem'];
            $_SESSION['userAccessLevel'] = $this->result[0]['adms_niveis_acesso_id'];
            $_SESSION['userOrdemAcesso'] = $this->result[0]['ornic'];
            return $this->result = true;
        }
        return $this->messageErroLogin();
    }
    
    private function messageErroLogin()
    {
        $_SESSION['msg'] = "<div class='alert alert-danger'>Usuário ou senha incorreto</div>";
        return $this->result = false;
    }
    
    /* logar no sistema */
    private function acceptLogin()
    {
        if ($this->result) {
            return $this->validatePassword();
        }
        return $this->messageErroLogin();
    }
}
