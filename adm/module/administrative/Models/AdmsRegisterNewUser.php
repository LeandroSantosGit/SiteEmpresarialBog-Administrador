<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsRegisterNewUser
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsRegisterNewUser
{
    private $result;
    private $dados;
    private $dadoId;
    private $photo;
    
    function getResult()
    {
        return $this->result;
    }

    public function addNewUser(array $dados)
    {
        $this->dados = $dados;
        $this->photo = $this->dados['imageNew'];
        unset($this->dados['imageNew']);
        
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->validateEmail();
        }
        return $this->result = false;
    }
    
    /* validar email e senha */
    private function validateEmail() {
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
            return $this->insertNewUser();
        }
        return $this->result = false;
    }
    
    /* executar update nos novos dados so usuário */
    private function insertNewUser()
    {
        $this->dados['senha'] = password_hash($this->dados['senha'], PASSWORD_DEFAULT);
        $this->dados['created'] = date("Y-m-d H:i:s");
        
        $formatNamePhoto = new \Module\administrative\Models\helper\AdmsFormatCharacter();
        $this->dados['imagem'] = $formatNamePhoto->formatCharacters($this->photo['name']);
        
        $registerUser = new \Module\administrative\Models\helper\AdmsCreate();
        $registerUser->exeCreate("adms_usuarios",$this->dados);
        if ($registerUser->getResult()) {
            if (empty($this->photo['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Usuário cadastrado com sucesso.</div>";
                return $this->result = true;
            }
            $this->dados['id'] = $registerUser->getResult();
            return $this->validatePhoto();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Usuário não cadastrado, tente novamente.</div>";
        return $this->result = false;
    }
    
    /* formatar caracteres, realizar upload, apagar imagem */
    private function validatePhoto()
    {
        $uploadImg = new \Module\administrative\Models\helper\AdmsUploadImgRed();
        $uploadImg->uploadImd(
                $this->photo,
                'assets/image/user/' . $this->dados['id'] . '/',
                $this->dados['imagem'],
                150,
                150
        );
        if ($uploadImg->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Usuário cadastrado com sucesso.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Usuário não cadastrado, tente novamente.</div>";
        return $this->result = false;
    }
    
    public function listRegister()
    {
        $listSelect = new \Module\administrative\Models\helper\AdmsRead();
        $listSelect->fullRead(
                "SELECT id idNivac, nome nomeNivac
                FROM adms_niveis_acessos
                WHERE ordem >=:ordem
                ORDER BY nome ASC",
                "ordem=" . $_SESSION['userOrdemAcesso']);
        $register['nivac'] = $listSelect->getResult();
        
        $listSelect->fullRead(
                "SELECT id idSiti, nome nomeSiti
                FROM adms_situacao_users 
                ORDER BY nome ASC");
        $register['siti'] = $listSelect->getResult();
        
        $this->result = ['nivac' => $register['nivac'],'siti' => $register['siti']];
        return $this->result;
    }
}
