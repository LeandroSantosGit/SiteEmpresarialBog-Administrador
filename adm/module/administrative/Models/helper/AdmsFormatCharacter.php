<?php

namespace Module\administrative\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsFormatCharacter
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsFormatCharacter
{
    private $name;
    private $format;
    
    public function formatCharacters($name)
    {
        $this->name = (string) $name;
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïð
                ñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:,\\\'<>°ºª';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiid
                noooooouuuyybyRr';
        $this->name = strtr(utf8_decode($this->name), utf8_decode($this->format['a']), $this->format['b']);
        $this->name = strip_tags(str_replace(' ', '-', $this->name));
        $this->name = strtolower(str_replace(['------', '----', '---', '--'], '-', $this->name));
        return $this->name;
    }
}
