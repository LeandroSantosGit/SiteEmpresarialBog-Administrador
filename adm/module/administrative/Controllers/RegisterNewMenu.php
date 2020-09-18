<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of RegisterNewMenu
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class RegisterNewMenu
{
    private $dados;
    
    public function registerInfoMenu()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['registerMenu'])) {
            unset($this->dados['registerMenu']);
            $addMenu = new \Module\administrative\Models\AdmsRegisterNewMenu();
            $addMenu->registerMenu($this->dados);
            if ($addMenu->getResult()) {
                $urlRedirect = URLADM . 'list-menu/list-itens-menu';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
        }
        return $this->renderView();
    }
    
    private function renderView()
    {
        $listSelect = new \Module\administrative\Models\AdmsRegisterNewMenu();
        $this->dados['select'] = $listSelect->listRegisterItemMenu();
        
        $button = [
            'listMenu' => [
                'menu_controller' => 'list-menu',
                'menu_metodo' => 'list-itens-menu']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonMenu'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $loadView = new \Config\ConfigView("administrative/Views/menu/registerNewMenu", $this->dados);
        $loadView->renderView();
    }
}
