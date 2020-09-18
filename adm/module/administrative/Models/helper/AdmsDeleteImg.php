<?php

namespace Module\administrative\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsDeleteImg
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsDeleteImg
{
    private $nameImg;
    private $directory;
    
    public function deleteImage($nameImg, $directory = null) {
     $this->nameImg = (string) $nameImg;
     $this->directory = (string) $directory;
     $this->excludeImage();
     if (!empty($this->directory)) {
         $this->excludeDirectory();
     }
    }
    
    private function excludeImage()
    {
        if (file_exists($this->nameImg)) {
            unlink($this->nameImg);
        }
    }
    
    private function excludeDirectory()
    {
        if (file_exists($this->directory)) {
            rmdir($this->directory);
        }
    }
}
