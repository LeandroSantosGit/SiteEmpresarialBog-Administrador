<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of RegisterNewPage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class RegisterNewPage
{
    private $dados;
    
    public function registerInfoPage()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['registerNewPage'])) {
            unset($this->dados['registerNewPage']);
            $registerPg = new \Module\administrative\Models\AdmsRegisterNewPage();
            $registerPg->registerPage($this->dados);
            if ($registerPg->getResult()) {
                $urlRedirect = URLADM . 'list-page/list-pages';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
        }
        return $this->renderView();
    }
    
    private function renderView()
    {
        $listSelect = new \Module\administrative\Models\AdmsRegisterNewPage();
        $this->dados['select'] = $listSelect->listRegisterPage();
        
        $button = [
            'listPage' => [
                'menu_controller' => 'list-page',
                'menu_metodo' => 'list-pages']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonAcesso'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $loadView = new \Config\ConfigView("administrative/Views/page/registerNewPage", $this->dados);
        $loadView->renderView();
    }
}
