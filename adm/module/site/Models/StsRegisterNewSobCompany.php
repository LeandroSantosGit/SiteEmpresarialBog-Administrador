<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsRegisterNewSobCompany
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsRegisterNewSobCompany
{
    private $result;
    private $dados;
    private $dadoId;
    private $photo;
    private $lastSobCompany;
    
    function getResult()
    {
        return $this->result;
    }

    public function viewInfoCompany($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $infoCompany = new \Module\administrative\Models\helper\AdmsRead();
        $infoCompany->fullRead(
                "SELECT *
                FROM sts_sob_empresa
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $infoCompany->getResult();
        return $this->result;
    }
    
    public function registerNewSobCompany(array $dados)
    {
        $this->dados = $dados;
        $this->photo = $this->dados['imageNew'];
        unset($this->dados['imageNew']);
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->insertNewSobCompany();
        }
        return $this->result = false;
    }
    
    private function insertNewSobCompany()
    {
        $this->dados['created'] = date("Y-m-d H:i:s");
        $formatCharacter = new \Module\administrative\Models\helper\AdmsFormatCharacter();
        $this->dados['imagem'] = $formatCharacter->formatCharacters($this->photo['name']);
        $this->viewLastSobCompany();
        $this->dados['ordem'] = $this->lastSobCompany[0]['ordem'] + 1;
        $addSobCompany = new \Module\administrative\Models\helper\AdmsCreate();
        $addSobCompany->exeCreate("sts_sob_empresa", $this->dados);
        if ($addSobCompany->getResult()) {
            if (empty($this->photo['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Sobre "
                        . "empresa cadastro</div>";
                return $this->result = true;
            }
            $this->dados['id'] = $addSobCompany->getResult();
            return $this->uploadPhoto();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Sobre "
                . "empresa não cadastro</div>";
        return $this->result = false;
    }
    
    private function viewLastSobCompany()
    {
        $viewSobCompany = new \Module\administrative\Models\helper\AdmsRead();
        $viewSobCompany->fullRead(
                "SELECT ordem
                FROM sts_sob_empresa
                ORDER BY ordem DESC
                LIMIT :limit",
                "limit=1");
        $this->lastSobCompany = $viewSobCompany->getResult();
    }
    
    private function uploadPhoto()
    {
        $upload = new \Module\administrative\Models\helper\AdmsUploadImgRed();
        $upload->uploadImd(
                $this->photo,
                '../site/assets/images/imgsInfoCompany/' . $this->dados['id'] . '/',
                $this->dados['imagem'],
                1920,
                846
        );
        if ($upload->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Sobre "
                    . "empresa cadastro e upload da imagem realizado</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-info'>Erro, sobre "
                . "empresa cadastro. Erro ao realizar upload da imagem</div>";
        return $this->result = false;
    }
    
    public function listSobCompany()
    {
        $list = new \Module\administrative\Models\helper\AdmsRead();
        $list->fullRead("SELECT id idSit, nome nomeSit FROM adms_situacao ORDER BY nome ASC");
        $register['sit'] = $list->getResult();
        
        $this->result = ['sit' => $register['sit']];
        return $this->result;
    }
}
