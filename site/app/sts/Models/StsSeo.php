<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsSeo
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsSeo
{
    private $result;
    private $resultNetwork;
    private $urlController;
    private $url;
    private $urlComplete;
    private $urlParam;
    private $table;
    private $column;
    private $listSeoBasic;
    private static $format;


    public function listSeo($Table = null, $Column = null, $Value = null)
    {
        $this->mountUrl();
        $this->urlParam = (string) $Value;
        if (!empty($this->urlParam)) {
            $this->table = (string) $Table;
            $this->column = (string) $Column;
            $this->listSeoBasic = $this->listSeoPage();
            $this->listSeoCustom();
        } else {
            $this->listSeoPage();
            $this->result[0]['dirImage'] = 'page';
        }
        $this->listSocialNetwork();
        return $this->result;
    }
    
    private function listSeoCustom()
    {
        $listSeoCustom = new \Sts\Models\helper\StsRead();
        $listSeoCustom->fullRead(
                "SELECT
                    id,
                    titulo,
                    keywords,
                    description,
                    author,
                    imagem
                FROM
                    {$this->table}
                WHERE
                    {$this->column} =:value
                ORDER BY
                    id ASC
                LIMIT :limit",
                "value={$this->urlParam}&limit=1");
        $this->result = $listSeoCustom->getResult();
        $this->result[0]['tipo_rob'] = $this->listSeoBasic[0]['tipo_rob'];
        $this->result[0]['endereco'] = $this->listSeoBasic[0]['endereco'] . '/' . $this->urlParam;
        $this->result[0]['dirImage'] = $this->listSeoBasic[0]['endereco'];
    }


    private function listSeoPage()
    {
        $listSeoPage = new \Sts\Models\helper\StsRead();
        $listSeoPage->fullRead(
                'SELECT
                    pag.id,
                    pag.endereco,
                    pag.titulo,
                    pag.keywords,
                    pag.description,
                    pag.author,
                    pag.imagem,
                    rob.tipo AS tipo_rob
                FROM
                    sts_paginas AS pag
                INNER JOIN
                    sts_robots AS rob
                    ON rob.id = pag.sts_robot_id
                WHERE
                    pag.controller =:controller
                ORDER BY
                    pag.id ASC
                LIMIT :limit',
                "controller={$this->urlController}&limit=1");
        $this->result = $listSeoPage->getResult();
        return $this->result;
    }


    private function listSocialNetwork()
    {
        $listFacebook = new \Sts\Models\helper\StsRead();
        $listFacebook->fullRead(
                'SELECT
                    og_site_name,
                    og_locale,
                    fb_admins,
                    twitter_site
                FROM
                    sts_seo
                WHERE
                    id =:id
                LIMIT :limit',
                "id=1&limit=1");
        $this->resultNetwork = $listFacebook->getResult();
        $this->result[0]['og_site_name'] = $this->resultNetwork[0]['og_site_name'];
        $this->result[0]['og_locale'] = $this->resultNetwork[0]['og_locale'];
        $this->result[0]['fb_admins'] = $this->resultNetwork[0]['fb_admins'];
        $this->result[0]['twitter_site'] = $this->resultNetwork[0]['twitter_site'];
    }

    private function mountUrl()
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
            $this->UrlController = $this->convertControllerUrl(CONTROLER);
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
    
    private function convertControllerUrl($StringUrl)
    {
        $UrlController = str_replace(" ", "", ucwords(implode(" ", explode("-", strtolower($StringUrl)))));
        return $UrlController;
    }
}
