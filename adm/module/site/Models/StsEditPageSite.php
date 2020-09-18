<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsEditPageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsEditPageSite
{
    private $result;
    private $dados;
    private $dadoId;
    private $photo;
    private $imgOld;
    
    function getResult()
    {
        return $this->result;
    }

    public function viewInfoPageSite($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewPage = new \Module\administrative\Models\helper\AdmsRead();
        $viewPage->fullRead(
                "SELECT *
                FROM sts_paginas
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewPage->getResult();
        return $this->result;
    }
    
    public function alterPageSite(array $dados)
    {
        $this->dados = $dados;
        $this->photo = $this->dados['imageNew'];
        $this->imgOld = $this->dados['imageOld'];
        unset($this->dados['imageNew'], $this->dados['imageOld']);
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->uploadNewImage();
        }
        return $this->result = false;
    }
    
    private function uploadNewImage()
    {
        if (empty($this->photo['name'])) {
            return $this->updateEditPage();
        }
        $formatCharacter = new \Module\administrative\Models\helper\AdmsFormatCharacter();
        $this->dados['imagem'] = $formatCharacter->formatCharacters($this->photo['name']);
        
        $uploadImg = new \Module\administrative\Models\helper\AdmsUploadImgRed();
        $uploadImg->uploadImd(
                $this->photo,
                '../site/assets/images/page/' . $this->dados['id'] . '/',
                $this->dados['imagem'],
                1200,
                627
        );
        if ($uploadImg->getResult()) {
            $this->deleteImageOld();
            return $this->updateEditPage();
        }
        return $this->result = false;
    }
    
    private function deleteImageOld()
    {
        $deleteImg = new \Module\administrative\Models\helper\AdmsDeleteImg();
        $deleteImg->deleteImage(
                '../site/assets/images/page/'
                . $this->dados['id']
                . '/'
                . $this->imgOld
        );
    }
    
    private function updateEditPage()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updatePage = new \Module\administrative\Models\helper\AdmsUpdate();
        $updatePage->exeUpdate(
                "sts_paginas",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dados['id']}"
        );
        if ($updatePage->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Página "
                    . "do site atualizado</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Página "
                    . "do site não atualizado</div>";
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
