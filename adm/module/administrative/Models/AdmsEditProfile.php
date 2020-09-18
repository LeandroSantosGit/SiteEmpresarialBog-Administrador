<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsEditProfile
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsEditProfile
{
    private $result;
    private $dados;
    private $photo;
    private $imgageOld;
    
    function getResult()
    {
        return $this->result;
    }

    public function AdmsEditProfileUser(array $dados)
    {
        $this->dados = $dados;
        $this->photo = $this->dados['imageNew'];
        $this->imgageOld = $this->dados['imageOld'];
        unset($this->dados['imageNew'], $this->dados['imageOld']);
        
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->validateEmail();
        }
        return $this->result = false;
    }
    
    private function validateEmail() {
        $editUser = true;
        $valideEmail = new \Module\administrative\Models\helper\AdmsValidateEmail();
        $valideEmail->validateEmail($this->dados['email']);

        $valideEmailUnique = new \Module\administrative\Models\helper\AdmsEmailUnique();
        $valideEmailUnique->validateEmailUnique(
                $this->dados['email'],
                $editUser,
                $_SESSION['userId']
        );

        $valideUser = new \Module\administrative\Models\helper\AdmsValidateUser();
        $valideUser->validateUser(
                $this->dados['usuario'],
                $editUser,
                $_SESSION['userId']
        );

        if ($valideEmail->getResult() 
            && $valideEmailUnique->getResult()
            && $valideUser->getResult()
        ) {
            return $this->validatePhoto();
        }
        return $this->result = false;
    }

    /* formatar caracteres, realizar upload, apagar imagem */
    private function validatePhoto()
    {
        if (empty($this->photo['name'])) {
            $this->updateEditProfile();
        } else {
            $formatNamePhoto = new \Module\administrative\Models\helper\AdmsFormatCharacter();
            $this->dados['imagem'] = $formatNamePhoto->formatCharacters($this->photo['name']);
            $uploadImg = new \Module\administrative\Models\helper\AdmsUploadImgRed();
            $uploadImg->uploadImd(
                    $this->photo,
                    'assets/image/user/' . $_SESSION['userId'] . '/',
                    $this->dados['imagem'],
                    150,
                    150
            );
            if ($uploadImg->getResult()) {
                $deleteImg = new \Module\administrative\Models\helper\AdmsDeleteImg();
                $deleteImg->deleteImage('assets/image/user/' 
                        . $_SESSION['userId'] . '/' . $this->imgageOld);
                $this->updateEditProfile();
            } else {
                $this->result = false;
            }
        }
    }
    
    /* executar update nos novos dados so usuário */
    private function updateEditProfile()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateProfile = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateProfile->exeUpdate(
                "adms_usuarios",
                $this->dados,
                "WHERE id =:id", "id=" . $_SESSION['userId']
        );
        if ($updateProfile->getResult()) {
            $_SESSION['userName'] = $this->dados['nome'];
            $_SESSION['userEmail'] = $this->dados['email'];
            $_SESSION['userImage'] = $this->dados['imagem'];
            $_SESSION['msg'] = "<div class='alert alert-success'>Seu perfil foi atualizado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Seu perfil não foi atualizado.</div>";
        return $this->result = false;
    }
}
