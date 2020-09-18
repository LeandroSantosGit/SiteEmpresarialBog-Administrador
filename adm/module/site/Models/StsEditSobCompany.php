<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsEditSobCompany
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsEditSobCompany
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
    
    public function viewSobCompany($dadoId)
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
    
    public function alterSobCompany(array $dados)
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
            return $this->updateEditSobCompany();
        }
        $formatCharacter = new \Module\administrative\Models\helper\AdmsFormatCharacter();
        $this->dados['imagem'] = $formatCharacter->formatCharacters($this->photo['name']);
        
        $uploadImg = new \Module\administrative\Models\helper\AdmsUploadImgRed();
        $uploadImg->uploadImd(
                $this->photo,
                '../site/assets/images/imgsInfoCompany/' . $this->dados['id'] . '/',
                $this->dados['imagem'],
                500,
                400
        );
        if ($uploadImg->getResult()) {
            $this->deleteImageOld();
            return $this->updateEditSobCompany();
        }
        return $this->result = false;
    }
    
    private function deleteImageOld()
    {
        $deleteImg = new \Module\administrative\Models\helper\AdmsDeleteImg();
        $deleteImg->deleteImage(
                '../site/assets/images/imgsInfoCompany/'
                . $this->dados['id']
                . '/'
                . $this->imgOld
        );
    }
    
    private function updateEditSobCompany()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateSobCompany = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateSobCompany->exeUpdate(
                "sts_sob_empresa",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dados['id']}"
        );
        if ($updateSobCompany->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Sobre "
                    . "empresa atualizado</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Sobre "
                . "empresa não atualizado</div>";
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
