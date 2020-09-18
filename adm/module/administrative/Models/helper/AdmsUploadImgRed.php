<?php

namespace Module\administrative\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsUploadImgRed
 * 
 * Redimencionar imagem para 150x150, criar diretorio e salvar 
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsUploadImgRed
{
    private $dadosImg;
    private $directory;
    private $nameImg;
    private $result;
    private $image;
    private $width;
    private $heidth;
    private $imgResized;
    
    function getResult()
    {
        return $this->result;
    }

    public function uploadImd(array $dadosImage, $directory, $nameImg, $width, $heigth)
    {
        $this->dadosImg = $dadosImage;
        $this->directory = $directory;
        $this->nameImg = $nameImg;
        $this->width = $width;
        $this->heidth = $heigth;
        $this->validadeFormatImage();
        
        if ($this->image) {
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Erro no formato da
                imagem, selecione imagem com formato JPEG ou PNG</div>";
        return $this->result = false;
    }
    
    /* validar o formto da imagem apenas JPEG e PNG e realizar upload da imagem */
    private function validadeFormatImage()
    {
        switch ($this->dadosImg['type']) {
            case 'image/jpeg':
            case 'image/pjpeg':
                $this->image = imagecreatefromjpeg($this->dadosImg['tmp_name']);
                $this->resizeImg();
                $this->validateDirectory();
                imagejpeg($this->imgResized, $this->directory . $this->nameImg);
                break;
            case 'image/png':
            case 'image/x-png':
                $this->image = imagecreatefrompng($this->dadosImg['tmp_name']);
                $this->resizeImg();
                $this->validateDirectory();
                imagepng($this->imgResized, $this->directory . $this->nameImg);
                break;
        }
    }
    
    /* se nao existir diretorio irá cria-lo */
    private function validateDirectory()
    {
        if (!file_exists($this->directory) && !is_dir($this->directory)) {
            mkdir($this->directory, 0755);
        }
    }
    
    /** Redimencionar foto para 150x150 */
    private function resizeImg()
    {
        $widthActual = imagesx($this->image);
        $heidthActual = imagesy($this->image);
        $this->imgResized = imagecreatetruecolor($this->width, $this->heidth);
        imagecopyresampled(
                $this->imgResized,
                $this->image,
                0,
                0,
                0,
                0,
                $this->width,
                $this->heidth,
                $widthActual,
                $heidthActual
        );
    }
}
