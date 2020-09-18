<?php

namespace App\sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Contato
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class Contato
{
    private $dados;
    
    public function index()
    {
        $this->registerForm();
        $this->seo();
        $this->menu();
        $this->footer();

        $loadView = new \Core\ConfigView('sts/Views/contact/contact', $this->dados);
        $loadView->renderView();
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
    
    private function registerForm()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['registerMsgContact'])) {
            unset($this->dados['registerMsgContact']);
            $regisContact = new \Sts\Models\StsContato();
            $regisContact->registerContact($this->dados);
            if ($regisContact->getResult()) {
                return $this->dados['form'] = null;
            }
            return $this->dados['form'] = $this->dados;
        }
    }
}
