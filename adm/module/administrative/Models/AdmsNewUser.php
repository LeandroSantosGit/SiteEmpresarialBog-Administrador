<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit(); 
}

/**
 * Description of AdmsNewUser
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsNewUser
{
    private $dados;
    private $result;
    private $infoCadUser;
    private $configEmail;
    
    function getResult()
    {
        return $this->result;
    }
    
    /* egistrar novo usuario */
    public function registerNewUser(array $dados)
    {
        $this->dados = $dados;
        $this->validateInput();
        if ($this->result) {
            $valideEmail = new \Module\administrative\Models\helper\AdmsValidateEmail();
            $valideEmail->validateEmail($this->dados['email']);
            
            $valideEmailUnique = new \Module\administrative\Models\helper\AdmsEmailUnique();
            $valideEmailUnique->validateEmailUnique($this->dados['email']);
            
            $valideUser = new \Module\administrative\Models\helper\AdmsValidateUser();
            $valideUser->validateUser($this->dados['usuario']);
            
            $validePassword = new \Module\administrative\Models\helper\AdmsValidatePassword();
            $validePassword->validatePassword($this->dados['senha']);
            
            if ($valideEmail->getResult()
                    && $valideEmailUnique->getResult()
                    && $valideUser->getResult()
                    && $validePassword->getResult()
            ) {
                $this->insertNewUser();
            } else {
                $this->result = false;
            }            
        }
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
    
    private function encryptPassword()
    {
        $this->infoRegisterUser();
        $this->dados['senha'] = password_hash($this->dados['senha'], PASSWORD_DEFAULT);
        $this->dados['config_email'] = md5($this->dados['senha'] . date('Y-m-d H:i'));
        $this->dados['adms_niveis_acesso_id'] = $this->infoCadUser[0]['adms_niveis_acesso_id'];
        $this->dados['adms_situacao_user_id'] = $this->infoCadUser[0]['adms_situacao_user_id'];
        $this->dados['created'] = date('Y-m-d H:i:s');
    }
    
    private function infoRegisterUser()
    {
        $infoUser = new \Module\administrative\Models\helper\AdmsRead();
        $infoUser->fullRead(
                "SELECT
                    envio_email_config,
                    adms_niveis_acesso_id,
                    adms_situacao_user_id
                FROM
                    adms_cadastro_user
                WHERE
                    id =:id
                LIMIT
                    :limit",
                "id=1&limit=1");
        $this->infoCadUser = $infoUser->getResult();
    }

    private function insertNewUser()
    {
        $this->encryptPassword();
        $insertUser = new \Module\administrative\Models\helper\AdmsCreate();
        $insertUser->exeCreate('adms_usuarios', $this->dados);
        if ($insertUser->getResult()) {
            if ($this->infoCadUser[0]["envio_email_config"] == 1) {
                return $this->sendConfirmEmail();
            }
            $_SESSION['msg'] = "<div class='alert alert-success'>Usuário cadastro com sucesso</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Usuário não cadastro, tente novamente</div>";
        return $this->result = false;
    }
    
    private function sendConfirmEmail()
    {
        $this->contentEmailNewUser();
        $sendEmail = new \Module\administrative\Models\helper\AdmsSubmitEmail();
        $sendEmail->sendEmail($this->configEmail);
        if ($sendEmail->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Usuário cadastro
                com sucesso. Enviamos email com link para confirmar cadastro.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-primary'>Usuário cadastro
                com sucesso. Erro, não conseguimos enviar email com link para confirmar cadastro.</div>";
        return $this->result = false;
    }
    
    private function contentEmailNewUser()
    {
        $name = explode(" ", $this->dados['nome']);
        $firstName = $name[0];
        $this->configEmail['destino_nome'] = $firstName;
        $this->configEmail['destino_email'] = $this->dados['email'];
        $this->configEmail['titulo_email'] = "Confirmar email";
        
        $this->configEmail['conteudo_email'] = "Caro(a) $firstName, <br><br> 
            Obrigado por se cadastrar conosco. Para ativar seu perfil, 
            clique no link a baixo:<br><br><a href='" . URLADM . "confirmemail/confirm-email-user?key=" 
            . $this->dados['config_email'] ."'>Clique aqui</a><br><br>";
        
        $this->configEmail['conteudo_text_email'] = "Caro(a) $firstName, <br><br>
            Obrigado por se cadastrar conosco. Para ativar seu perfil, 
            copie o endereço a baixo e cole no sue navegador:" .URLADM . 
            "confirmemail/confirm-email-user?key=" . $this->dados['config_email'];
    }
}
