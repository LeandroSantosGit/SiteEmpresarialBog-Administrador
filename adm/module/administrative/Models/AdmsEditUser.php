<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsEditUser
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsEditUser
{
    private $result;
    private $dados;
    private $dadoId;
    private $photo;
    private $imgageOld;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function viewInfoUser($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $profileUser = new \Module\administrative\Models\helper\AdmsRead();
        $profileUser->fullRead(
                "SELECT user.*
                FROM adms_usuarios user
                INNER JOIN
                    adms_niveis_acessos nivac
                    ON nivac.id = user.adms_niveis_acesso_id
                WHERE user.id =:id
                      AND nivac.ordem >:ordem
                LIMIT :limit", 
                "id={$this->dadoId}&ordem=" . $_SESSION['userOrdemAcesso'] . "&limit=1");
        $this->result = $profileUser->getResult();
        return $this->result;
    }

    public function AdmsEditUser(array $dados)
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
                $this->dados['id']
        );

        $valideUser = new \Module\administrative\Models\helper\AdmsValidateUser();
        $valideUser->validateUser(
                $this->dados['usuario'],
                $editUser,
                $this->dados['id']
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
            $this->updateEditUser();
        } else {
            $formatNamePhoto = new \Module\administrative\Models\helper\AdmsFormatCharacter();
            $this->dados['imagem'] = $formatNamePhoto->formatCharacters($this->photo['name']);
            $uploadImg = new \Module\administrative\Models\helper\AdmsUploadImgRed();
            $uploadImg->uploadImd(
                    $this->photo,
                    'assets/image/user/' . $this->dados['id'] . '/',
                    $this->dados['imagem'],
                    150,
                    150
            );
            if ($uploadImg->getResult()) {
                $deleteImg = new \Module\administrative\Models\helper\AdmsDeleteImg();
                $deleteImg->deleteImage('assets/image/user/' 
                        . $this->dados['id'] . '/' . $this->imgageOld);
                $this->updateEditUser();
            } else {
                $this->result = false;
            }
        }
    }
    
    /* executar update nos novos dados so usuário */
    private function updateEditUser()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateProfile = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateProfile->exeUpdate(
                "adms_usuarios",
                $this->dados,
                "WHERE id =:id", "id=" . $this->dados['id']
        );
        if ($updateProfile->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Usuário foi atualizado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Usuário não foi atualizado.</div>";
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
        
        $listSelect->fullRead("SELECT id idSiti, nome nomeSiti FROM adms_situacao_users ORDER BY nome ASC");
        $register['siti'] = $listSelect->getResult();
        
        $this->result = ['nivac' => $register['nivac'],'siti' => $register['siti']];
        return $this->result;
    }
}
