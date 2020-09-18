<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsEditCarousel
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsEditCarousel
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

    public function viewInfoCarousel($dadoId)
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
    
    public function alterCarrourel(array $dados)
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
            return $this->updateEditCarousel();
        }
        $formatCharacter = new \Module\administrative\Models\helper\AdmsFormatCharacter();
        $this->dados['imagem'] = $formatCharacter->formatCharacters($this->photo['name']);
        
        $uploadImg = new \Module\administrative\Models\helper\AdmsUploadImgRed();
        $uploadImg->uploadImd(
                $this->photo,
                '../site/assets/images/carousel/' . $this->dados['id'] . '/',
                $this->dados['imagem'],
                1920,
                846
        );
        if ($uploadImg->getResult()) {
            $this->deleteImageOld();
            return $this->updateEditCarousel();
        }
        return $this->result = false;
    }
    
    private function deleteImageOld()
    {
        $deleteImg = new \Module\administrative\Models\helper\AdmsDeleteImg();
        $deleteImg->deleteImage(
                '../site/assets/images/carousel/'
                . $this->dados['id']
                . '/'
                . $this->imgOld
        );
    }

    private function updateEditCarousel()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateCarousel = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateCarousel->exeUpdate(
                "sts_carousels",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dados['id']}"
        );
        if ($updateCarousel->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Slide do "
                    . "carousel atualizado</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Slide do "
                    . "carousel não atualizado</div>";
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
