<?php

namespace Module\administrative\Controllers;

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
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $loadView = new \Config\ConfigView("administrative/Views/home/home", $this->dados);
        $loadView->renderView();
    }
}
