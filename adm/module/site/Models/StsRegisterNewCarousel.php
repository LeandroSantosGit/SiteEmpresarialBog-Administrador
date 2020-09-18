<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsRegisterNewCarousel
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsRegisterNewCarousel
{
    private $result;
    private $dados;
    private $dadoId;
    private $photo;
    private $lastCarousel;
    
    function getResult()
    {
        return $this->result;
    }

    public function viewCarousel($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewCarousel = new \Module\administrative\Models\helper\AdmsRead();
        $viewCarousel->fullRead(
                "SELECT *
                FROM sts_carousels
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewCarousel->getResult();
        return $this->result;
    }
    
    public function registerNewCarousel(array $dados)
    {
        $this->dados = $dados;
        $this->photo = $this->dados['imageNew'];
        unset($this->dados['imageNew']);
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->insertNewCarousel();
        }
        return $this->result = false;
    }
    
    private function insertNewCarousel()
    {
        $this->dados['created'] = date("Y-m-d H:i:s");
        $formatCharacter = new \Module\administrative\Models\helper\AdmsFormatCharacter();
        $this->dados['imagem'] = $formatCharacter->formatCharacters($this->photo['name']);
        $this->viewLastCarousel();
        $this->dados['ordem'] = $this->lastCarousel[0]['ordem'] + 1;
        
        $addCarousel = new \Module\administrative\Models\helper\AdmsCreate();
        $addCarousel->exeCreate("sts_carousels", $this->dados);
        if ($addCarousel->getResult()) {
            if (empty($this->photo['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Slide do "
                        . "carousel cadastro</div>";
                return $this->result = true;
            }
            $this->dados['id'] = $addCarousel->getResult();
            return $this->uploadPhoto();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Slide do carousel"
                . " não cadastro</div>";
        return $this->result = false;
    }
    
    private function viewLastCarousel()
    {
        $viewCarousel = new \Module\administrative\Models\helper\AdmsRead();
        $viewCarousel->fullRead(
                "SELECT ordem
                FROM sts_carousels
                ORDER BY ordem DESC
                LIMIT :limit",
                "limit=1");
        $this->lastCarousel = $viewCarousel->getResult();
    }


    private function uploadPhoto()
    {
        $upload = new \Module\administrative\Models\helper\AdmsUploadImgRed();
        $upload->uploadImd(
                $this->photo,
                '../site/assets/images/carousel/' . $this->dados['id'] . '/',
                $this->dados['imagem'],
                1920,
                846
        );
        if ($upload->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Slide do "
                    . "carousel cadastro e upload da imagem realizado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-info'>Erro, slide do "
                . "carousel cadastro. Erro ao realizar e upload da imagem.</div>";
        return $this->result = false;
    }
    
    public function listCarousel()
    {
        $list = new \Module\administrative\Models\helper\AdmsRead();
        $list->fullRead("SELECT id idColor, nome nomeColor FROM adms_cors ORDER BY nome ASC");
        $register['color'] = $list->getResult();
        
        $list->fullRead("SELECT id idSit, nome nomeSit FROM adms_situacao ORDER BY nome ASC");
        $register['sit'] = $list->getResult();
        
        $this->result = ['color' => $register['color'], 'sit' => $register['sit']];
        return $this->result;
    }
}
