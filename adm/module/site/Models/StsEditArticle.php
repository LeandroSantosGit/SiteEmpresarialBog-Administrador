<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsEditArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsEditArticle
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

    public function viewInfoArticle($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewArticle = new \Module\administrative\Models\helper\AdmsRead();
        $viewArticle->fullRead(
                "SELECT *
                FROM sts_artigos
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewArticle->getResult();
        return $this->result;
    }
    
    public function alterArticle(array $dados)
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
            return $this->updateEditArticle();
        }
        $formatCharacter = new \Module\administrative\Models\helper\AdmsFormatCharacter();
        $this->dados['imagem'] = $formatCharacter->formatCharacters($this->photo['name']);
        
        $uploadImg = new \Module\administrative\Models\helper\AdmsUploadImgRed();
        $uploadImg->uploadImd(
                $this->photo,
                '../site/assets/images/article/' . $this->dados['id'] . '/',
                $this->dados['imagem'],
                1200,
                627
        );
        if ($uploadImg->getResult()) {
            $this->deleteImageOld();
            return $this->updateEditArticle();
        }
        return $this->result = false;
    }
    
    private function deleteImageOld()
    {
        $deleteImg = new \Module\administrative\Models\helper\AdmsDeleteImg();
        $deleteImg->deleteImage(
                '../site/assets/images/article/'
                . $this->dados['id']
                . '/'
                . $this->imgOld
        );
    }
    
    private function updateEditArticle()
    {
        $slug = new \Module\administrative\Models\helper\AdmsFormatCharacter();
        $this->dados['slug'] = $slug->formatCharacters($this->dados['slug']);
        
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateArticle = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateArticle->exeUpdate(
                "sts_artigos",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dados['id']}"
        );
        if ($updateArticle->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Artigo "
                    . "atualizado</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Artigo "
                    . "não atualizado</div>";
        return $this->result = false;
    }
    
    public function listArticles()
    {
        $list = new \Module\administrative\Models\helper\AdmsRead();
        $list->fullRead("SELECT id idRobot, nome nomeRobot, tipo tipoRobot FROM sts_robots ORDER BY nome ASC");
        $register['robot'] = $list->getResult();
        
        $list->fullRead("SELECT id idSit, nome nomeSit FROM adms_situacao ORDER BY nome ASC");
        $register['sit'] = $list->getResult();
        
        $list->fullRead("SELECT id idUser, nome nomeUser FROM adms_usuarios ORDER BY nome ASC");
        $register['user'] = $list->getResult();
        
        $list->fullRead("SELECT id idTypeArt, nome nomeTypeArt FROM sts_tps_artigos ORDER BY nome ASC");
        $register['typeArticle'] = $list->getResult();
        
        $list->fullRead("SELECT id idCatArt, nome nomeCatArt FROM sts_cats_artigos ORDER BY nome ASC");
        $register['catArticle'] = $list->getResult();
        
        $this->result = [
            'robot' => $register['robot'],
            'sit' => $register['sit'],
            'user' => $register['user'],
            'typeArticle' => $register['typeArticle'],
            'catArticle' => $register['catArticle']
        ];
        return $this->result;
    }
}
