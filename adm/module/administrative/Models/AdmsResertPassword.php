<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsResertPassword
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsResertPassword
{
    private $result;
    private $dadosUpdate;
    private $dadosUser;
    private $dados;
    private $dadosEmail;
    
    function getResult()
    {
        return $this->result;
    }

    public function resetPasswordUser(array $dados)
    {
        $this->dados = $dados;
        $this->validateInput();
        if ($this->result) {
            $passDb = new \Module\administrative\Models\helper\AdmsRead();
            $passDb->fullRead(
                    "SELECT
                        id,
                        nome,
                        usuario,
                        recuperar_senha
                    FROM
                        adms_usuarios
                    WHERE
                        email =:email
                    LIMIT :limit", 
                    "email={$this->dados['email']}&limit=1");
            $this->dadosUser = $passDb->getResult();
            $this->checkUserDb();
        }
    }
    
    /* verificar se o usuario esta cadastrado no banco de dados */
    private function checkUserDb()
    {
        if (!empty($this->dadosUser)) {
            $this->validateKeyPassword();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Email não possui cadastrado</div>";
            $this->result = false;
        }
    }
    
    /* validar a chave de recuperar senha so usuario */
    private function validateKeyPassword()
    {
        if (!empty($this->dadosUser[0]['recuperar_senha'])) {
            $this->sendEmailReset();
        } else {
            $this->dadosUpdate['recuperar_senha'] = md5($this->dadosUser[0]['id'] . date("Y-m-d H:i:s"));
            $this->dadosUpdate['modified'] = date("Y-m-d H:i:s");
            $this->updateResetPassword();
        }
    }
    
    private function updateResetPassword()
    {
        $updateRecoverPass = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateRecoverPass->exeUpdate(
            "adms_usuarios", $this->dadosUpdate,
            "WHERE id =:id", "id={$this->dadosUser[0]['id']}");
        if ($updateRecoverPass->getResult()) {
            $this->dadosUser[0]['recuperar_senha'] = $this->dadosUpdate['recuperar_senha'];
            $this->sendEmailReset();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao recuperar a senha</div>";
            $this->result = false;
        }
    }
    
    /** Validar campos de input login */
    private function validateInput()
    {
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if (!$validInput->getResult()) {
            return $this->result = false;
        }
        return $this->validateEmail();
    }
    
    private function validateEmail()
    {
        $validEmail = new \Module\administrative\Models\helper\AdmsValidateEmail();
        $validEmail->validateEmail($this->dados['email']);
        if ($validEmail->getResult()) {
            return $this->result = true;
        }
        return $this->result = false;
    }
    
    private function sendEmailReset()
    {
        $this->contentEmailResetPass();
        $emailMailer = new \Module\administrative\Models\helper\AdmsSubmitEmail();
        $emailMailer->sendEmail($this->dadosEmail);
        if ($emailMailer->getResult()) {
           $_SESSION['msg'] = "<div class='alert alert-success'>Email enviado, 
                   verifique sua caixa de entrada.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-primary'>Erro ao enviar 
                email, tente novamente.</div>";
        return $this->result = false;
    }
    
    private function contentEmailResetPass()
    {
        $name = explode(" ", $this->dadosUser[0]['nome']);
        $this->dadosEmail['destino_nome'] = $name[0];
        $this->dadosEmail['destino_email'] = $this->dados['email'];
        $this->dadosEmail['titulo_email'] = "Recuperar Senha";
        $this->dadosEmail['conteudo_email'] = "Olá " . $name[0] . "<br><br> 
                Você solicitou uma alteração de senha.<br>
                Seguindo o link abaixo você poderá alterar a sua senha.<br>
                Para continuar o processo de recuperação de senha, clique no 
                link abaixo ou cole o endereço no seu navegador.<br><br>
                <a href='". URLADM . 'update-password/restore-password?key=' . 
                $this->dadosUser[0]['recuperar_senha'] . "'>Clique aqui</a><br><br>
                Usuário: " . $this->dadosUser[0]['usuario'] . "<br><br>
                Se você não solicitou essa alteração, nenhuma ação é necessária. 
                Sua senha permanerá a mesma até que você ative este código.<br><br>";
        
        $this->dadosEmail['conteudo_text_email'] = "Olá " . $name[0] . "Você 
                solicitou uma alteração de senha. Seguindo o link abaixo você 
                poderá alterar a sua senha. Para continuar o processo de recuperação 
                de senha, clique no link abaixo ou cole o endereço no seu 
                navegador. ". URLADM . "update-password/restore-password?key=" . 
                $this->dadosUser[0]['recuperar_senha'] . "Usuário: " . 
                $this->dadosUser[0]['usuario'] . "Se você não solicitou essa 
                alteração, nenhuma ação é necessária. Sua senha permanerá a 
                mesma até que você ative este código.";
    }
}
