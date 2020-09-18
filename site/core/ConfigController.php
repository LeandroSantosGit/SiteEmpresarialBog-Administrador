<?php

namespace Core;

/**
 * Description of ConfigController
 *
 * @author LeandroWEB
 */
class ConfigController
{    
    private $url;
    private $urlComplete;
    private $urlController;
    private $urlParam;
    private $classPage;
    private $classLoad;
    private $pages;
    private static $format;
    
    public function __construct() 
    {
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->checkUrl();
        } else {
            $this->urlController = $this->convertControllerUrl(CONTROLER);
            $this->urlParam = null;
        }
    }

    private function checkUrl()
    {
        $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
        $this->clearUrl();
        $this->urlComplete = explode("/", $this->url);
        if (isset($this->urlComplete[0])) {
            $this->urlController = $this->convertControllerUrl($this->urlComplete[0]);
        } else {
            $this->urlController = $this->convertControllerUrl(CONTROLER);
        }
        if (isset($this->urlComplete[1])) {
            $this->urlParam = $this->urlComplete[1];
        } else {
            $this->urlParam = null;
        }
    }

    private function clearUrl()
    {
        // clear tags and white space, slash
        $this->url = rtrim(strip_tags(trim($this->url)), "/");
        self::$format = array();
        self::$format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñ
            òóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        self::$format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidn
            oooooouuuyybyRr--------------------------------';
        $this->url = strtr(utf8_decode($this->url), utf8_decode(self::$format['a']), self::$format['b']);
    }

    private function convertControllerUrl($stringUrl)
    {
        $UrlController = str_replace(" ", "", ucwords(implode(" ", explode("-", strtolower($stringUrl)))));
        return $UrlController;
    }

    public function classLoadPage()
    {
        $listPg = new \Sts\Models\StsPages();
        $this->pages = $listPg->listPages($this->urlController);
        if ($this->pages) {
            return $this->checkClassPage();
        }
        $this->urlController = $this->convertControllerUrl(CONTROLER);
        return $this->classLoadPage();
    }
    
    private function checkClassPage()
    {
        extract($this->pages[0]);
        $this->classPage = "\\App\\{$tipo_tpg}\\Controllers\\" . $this->urlController;
        if (class_exists($this->classPage)) {
            return $this->checkMethodIndex();
        }
        $this->urlController = $this->convertControllerUrl(CONTROLER);
        return $this->classLoadPage();
    }

    private function checkMethodIndex()
    {
        $this->classLoad = new $this->classPage;
        if (method_exists($this->classLoad, "index")) {
            return $this->checkParamURL();
        }
        $this->urlController = $this->convertControllerUrl(CONTROLER);
        return $this->classLoadPage();
    }

    private function checkParamURL()
    {
        if ($this->urlParam !== null) {
            return $this->classLoad->index($this->urlParam);
        }
        return $this->classLoad->index();
    }
}
