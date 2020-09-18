<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsEditAboutArticles
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsEditAboutArticles
{
    private $result;
    private $dados;
    private $photo;
    private $imgOld;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function viewInfoAboutArticle()
    {
        $aboutArticle = new \Module\administrative\Models\helper\AdmsRead();
        $aboutArticle->fullRead(
                "SELECT *
                FROM sts_sobres
                WHERE id =:id
                LIMIT :limit",
                "id=1&limit=1");
        $this->result = $aboutArticle->getResult();
        return $this->result;
    }
    
    public function alterAboutArticle(array $dados)
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
            return $this->updateAboutArticle();
        }
        $formatCharacter = new \Module\administrative\Models\helper\AdmsFormatCharacter();
        $this->dados['imagem'] = $formatCharacter->formatCharacters($this->photo['name']);
        
        $uploadImg = new \Module\administrative\Models\helper\AdmsUploadImgRed();
        $uploadImg->uploadImd(
                $this->photo,
                '../site/assets/images/infoAuthor/1/',
                $this->dados['imagem'],
                1200,
                627
        );
        if ($uploadImg->getResult()) {
            $this->deleteImageOld();
            return $this->updateAboutArticle();
        }
        return $this->result = false;
    }
    
    private function deleteImageOld()
    {
        $deleteImg = new \Module\administrative\Models\helper\AdmsDeleteImg();
        $deleteImg->deleteImage(
                '../site/assets/images/infoAuthor/1/'
                . $this->imgOld
        );
    }
    
    private function updateAboutArticle()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateAboutArticle = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateAboutArticle->exeUpdate(
                "sts_sobres",
                $this->dados,
                "WHERE id =:id",
                "id=1"
        );
        if ($updateAboutArticle->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Conteúdo "
                    . "sobre da artigos atualizado</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Conteúdo "
                    . "sobre da artigos não atualizado</div>";
        return $this->result = false;
    }
    
    public function listSituationAboutArticle()
    {
        $list = new \Module\administrative\Models\helper\AdmsRead();
        $list->fullRead("SELECT id idSit, nome nomeSit FROM adms_situacao ORDER BY nome ASC");
        $register['sit'] = $list->getResult();
        
        $this->result = ['sit' => $register['sit']];
        return $this->result;
    }
}
