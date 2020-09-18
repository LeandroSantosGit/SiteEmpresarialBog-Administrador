<?php

namespace Config;

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
    private $urlMethod;
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
            $this->urlMethod = $this->convertMethodUrl(METODO);
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
            $this->urlMethod = $this->convertMethodUrl($this->urlComplete[1]);
        } else {
            $this->urlMethod = $this->convertMethodUrl(METODO);
        }
        if (isset($this->urlComplete[2])) {
            $this->urlParam = $this->urlComplete[2];
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
    
    private function convertMethodUrl($stringMethod)
    {
        //$urlMethod = str_replace(" ", "", ucwords(implode(" ", explode("-", strtolower($stringMethod)))));
        return lcfirst($this->convertControllerUrl($stringMethod));
    }

    public function classLoadPage()
    {
        $listPg = new \Module\administrative\Models\AdmsPages();
        $this->pages = $listPg->listPages($this->urlController, $this->urlMethod);
        if ($this->pages) {
            extract($this->pages[0]);
            $this->classPage = "\\Module\\{$tipo_pg}\\Controllers\\" . $this->urlController;
            if (class_exists($this->classPage)) {
                $this->checkMethod();
            } else {
                $this->urlController = $this->convertControllerUrl(CONTROLER);
                $this->urlMethod = $this->convertMethodUrl(METODO);
                $this->classLoadPage();
            }
        } else {
            $this->urlController = $this->convertControllerUrl('Login');
            $this->urlMethod = $this->convertControllerUrl('access');
            $this->classLoadPage();
        }
    }
    
    private function checkMethod()
    {
        $this->classLoad = new $this->classPage;
        if (method_exists($this->classLoad, $this->urlMethod)) {
            if ($this->urlParam !== null) {
                $this->classLoad->{$this->urlMethod}($this->urlParam);
            } else {
                $this->classLoad->{$this->urlMethod}();
            }
        } else {
            $this->urlController = $this->convertControllerUrl(CONTROLER);
            $this->urlMethod = $this->convertMethodUrl(METODO);
            $this->classLoadPage();
        }
    }
}
