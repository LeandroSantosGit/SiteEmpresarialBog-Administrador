<?php

namespace App\sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Home
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class Home
{
    private $dados;
    
    public function index()
    {
        $this->menu();
        $this->seo();
        $this->carouselHome();
        $this->serviceHome();
        $this->videoHome();
        $this->articleHome();
        $this->footer();
        
        $loadView = new \Core\ConfigView("sts/Views/home/home", $this->dados);
        $loadView->renderView();
    }
    
    private function articleHome()
    {
        $listArticle = new \Sts\Models\StsArticleHome();
        $this->dados['stsArtigos'] = $listArticle->listArticliHome();
    }

    private function videoHome()
    {
        $listVideos = new \Sts\Models\StsVideoHome();
        $this->dados['stsVideos'] = $listVideos->listVideoHome();
    }

    private function serviceHome()
    {
        $listServices = new \Sts\Models\StsServiceHome();
        $this->dados['stsServicos'] = $listServices->listServiceHome();
    }

    private function carouselHome()
    {
        $listCarousel = new \Sts\Models\StsCarouselHome();
        $this->dados['stsCarousels'] = $listCarousel->listCarouselHome();
    }

    private function seo()
    {
        $listSeo = new \Sts\Models\StsSeo();
        $this->dados['seo'] = $listSeo->listSeo();
    }

    private function menu()
    {
        $listMenu = new \Sts\Models\StsMenu();
        $this->dados['menu'] = $listMenu->listMenu();
    }
    
    private function footer()
    {
        $listFooter = new \Sts\Models\StsFooter();
        $this->dados['stsFooter'] = $listFooter->listFooter();
    }
}
