<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsRegisterNewPageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsRegisterNewPageSite
{
    private $result;
    private $dados;
    private $photo;
    private $lastPage;
    
    function getResult()
    {
        return $this->result;
    }

    public function registerPageSite(array $dados)
    {
        $this->dados = $dados;
        $this->photo = $this->dados['imageNew'];
        unset($this->dados['imageNew']);
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->insertNewPage();
        }
        return $this->result = false;
    }
    
    private function insertNewPage()
    {
        $this->dados['created'] = date("Y-m-d H:i:s");
        $formatCharacter = new \Module\administrative\Models\helper\AdmsFormatCharacter();
        $this->dados['imagem'] = $formatCharacter->formatCharacters($this->photo['name']);
        $this->viewLastPage();
        $this->dados['ordem_paginas'] = $this->lastPage[0]['ordem_paginas'] + 1;
        
        $addPage = new \Module\administrative\Models\helper\AdmsCreate();
        $addPage->exeCreate("sts_paginas", $this->dados);
        if ($addPage->getResult()) {
            if (empty($this->photo['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Página do "
                        . "site cadastro</div>";
                return $this->result = true;
            }
            $this->dados['id'] = $addPage->getResult();
            return $this->uploadPhoto();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Página do "
                . "site não cadastro</div>";
        return $this->result = false;
    }
    
    private function viewLastPage()
    {
        $viewPage = new \Module\administrative\Models\helper\AdmsRead();
        $viewPage->fullRead(
                "SELECT ordem_paginas
                FROM sts_paginas
                ORDER BY ordem_paginas DESC
                LIMIT :limit",
                "limit=1");
        $this->lastPage = $viewPage->getResult();
    }
    
    private function uploadPhoto()
    {
        $upload = new \Module\administrative\Models\helper\AdmsUploadImgRed();
        $upload->uploadImd(
                $this->photo,
                '../site/assets/images/page/' . $this->dados['id'] . '/',
                $this->dados['imagem'],
                1200,
                627
        );
        if ($upload->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Página do "
                    . "site cadastro e upload da imagem realizado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-info'>Erro, página do "
                . "site cadastro. Erro ao realizar e upload da imagem.</div>";
        return $this->result = false;
    }
    
    public function listPageSite()
    {
        $list = new \Module\administrative\Models\helper\AdmsRead();
        $list->fullRead("SELECT id idRobot, nome nomeRobot, tipo tipoRobot FROM sts_robots ORDER BY nome ASC");
        $register['robot'] = $list->getResult();
        
        $list->fullRead("SELECT id idTpPg, nome nomeTpPg, tipo tipoTpPg FROM sts_tipos_paginas ORDER BY nome ASC");
        $register['tipoPg'] = $list->getResult();
        
        $list->fullRead("SELECT id idSitPg, nome nomeSitPg FROM sts_situacaos_pgs ORDER BY nome ASC");
        $register['sitPg'] = $list->getResult();
        
        $this->result = [
            'robot' => $register['robot'], 
            'tipoPg' => $register['tipoPg'],
            'sitPg' => $register['sitPg']
        ];
        return $this->result;
    }
}
