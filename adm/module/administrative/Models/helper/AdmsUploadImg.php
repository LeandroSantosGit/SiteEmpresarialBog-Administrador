<?php

namespace Module\administrative\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsUploadImg
 * 
 * criar diretorio e salvar
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsUploadImg
{
    private $dadosImg;
    private $directory;
    private $nameImg;
    private $result;
    private $image;
    
    function getResult()
    {
        return $this->result;
    }

    public function uploadImd(array $dadosImage, $directory, $nameImg)
    {
        $this->dadosImg = $dadosImage;
        $this->directory = $directory;
        $this->nameImg = $nameImg;
        $this->validadeFormatImage();
    }
    
    /* validar o formto da imagem apenas JPEG e PNG */
    private function validadeFormatImage()
    {
        switch ($this->dadosImg['type']) {
            case 'image/jpeg':
            case 'image/pjpeg':
                $this->image = imagecreatefromjpeg($this->dadosImg['tmp_name']);
                break;
            case 'image/png':
            case 'image/x-png':
                $this->image = imagecreatefrompng($this->dadosImg['tmp_name']);
                break;
        }
        if ($this->image) {
            return $this->validateDirectory();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Erro no formato da
                imagem, selecione imagem com formato JPEG ou PNG</div>";
        return $this->result = false;
    }
    
    /* se nao existir diretorio irá cria-lo */
    private function validateDirectory()
    {
        if (!file_exists($this->directory) && !is_dir($this->directory)) {
            mkdir($this->directory, 0755);
        }
        $this->executeUpload();
    }
    
    /* realizar upload da imagem */
    private function executeUpload()    
    {
        if (move_uploaded_file($this->dadosImg['tmp_name'], $this->directory . $this->nameImg)) {
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Erro, imagem não foi salva, tente novamente</div>";
        return $this->result = false;
    }
}
