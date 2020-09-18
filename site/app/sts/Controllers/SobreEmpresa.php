<?php

namespace App\sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of SobreEmpresa
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class SobreEmpresa
{
    private $dados;
    
    public function index()
    {
        $this->menu();
        $this->seo();
        $this->infoCompany();
        $this->footer();

        $loadView = new \Core\ConfigView('sts/Views/infoCompany/infoCompany', $this->dados);
        $loadView->renderView();
    }
    
    private function infoCompany()
    {
        $listCompany = new \Sts\Models\StsInfoCompany();
        $this->dados['stsSobEmpresa'] = $listCompany->listInfCompany();
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
