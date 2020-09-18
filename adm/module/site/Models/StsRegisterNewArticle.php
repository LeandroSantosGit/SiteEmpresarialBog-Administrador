<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsRegisterNewArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsRegisterNewArticle
{
    private $result;
    private $dados;
    private $photo;
    
    function getResult()
    {
        return $this->result;
    }

    public function registerArticle(array $dados)
    {
        $this->dados = $dados;
        $this->photo = $this->dados['imageNew'];
        unset($this->dados['imageNew']);
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInputInclideTag();
        $validInput->validateInputTags($this->dados);
        if ($validInput->getResult()) {
            return $this->insertNewArticle();
        }
        return $this->result = false;
    }
    
    private function insertNewArticle()
    {
        $this->dados['created'] = date("Y-m-d H:i:s");
        $formatCharacterImg = new \Module\administrative\Models\helper\AdmsFormatCharacter();
        $this->dados['imagem'] = $formatCharacterImg->formatCharacters($this->photo['name']);
        
        $formatCharacterPage = new \Module\administrative\Models\helper\AdmsFormatCharacter();
        $this->dados['slug'] = $formatCharacterPage->formatCharacters($this->dados['slug']);
        
        $addArticle = new \Module\administrative\Models\helper\AdmsCreate();
        $addArticle->exeCreate("sts_artigos", $this->dados);
        if ($addArticle->getResult()) {
            if (empty($this->photo['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Artigo "
                        . "cadastro</div>";
                return $this->result = true;
            }
            $this->dados['id'] = $addArticle->getResult();
            return $this->uploadPhoto();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Artigo"
                . " não cadastro</div>";
        return $this->result = false;
    }
    
    private function uploadPhoto()
    {
        $upload = new \Module\administrative\Models\helper\AdmsUploadImgRed();
        $upload->uploadImd(
                $this->photo,
                '../site/assets/images/article/' . $this->dados['id'] . '/',
                $this->dados['imagem'],
                1200,
                627
        );
        if ($upload->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Artigo "
                    . "cadastro e upload da imagem realizado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-info'>Erro, artigo "
                . "cadastro. Erro ao realizar e upload da imagem.</div>";
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
