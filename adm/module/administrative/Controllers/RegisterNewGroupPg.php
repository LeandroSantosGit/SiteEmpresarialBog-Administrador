<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of RegisterNewGroupPg
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class RegisterNewGroupPg
{
    private $dados;
    
    public function registerInfoGroupPg()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['registerGroupPg'])) {
            unset($this->dados['registerGroupPg']);
            $registerGroPg = new \Module\administrative\Models\AdmsRegisterNewGroupPg();
            $registerGroPg->registerGroupPage($this->dados);
            if ($registerGroPg->getResult()) {
                $urlRedirect = URLADM . 'list-group-page/list-groups-pages';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
        }
        return $this->renderView();
    }
    
    private function renderView()
    {
        $button = [
            'listGrupPg' => [
                'menu_controller' => 'list-group-page',
                'menu_metodo' => 'list-groups-pages']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsGrupPg'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $loadView = new \Config\ConfigView("administrative/Views/groupPage/registerNewGroupPg", $this->dados);
        $loadView->renderView();
    }
}
