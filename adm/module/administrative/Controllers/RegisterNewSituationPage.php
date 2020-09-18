<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of RegisterNewSituationPage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class RegisterNewSituationPage
{
    private $dados;
    
    public function registerInfoSituationPage()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['registerSitPg'])) {
            unset($this->dados['registerSitPg']);
            $addSitPg = new \Module\administrative\Models\AdmsRegisterNewSituationPage();
            $addSitPg->registerSituationPage($this->dados);
            if ($addSitPg->getResult()) {
                $urlRedirect = URLADM . 'list-situation-page/list-situation-pages';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
        }
        return $this->renderView();
    }
    
    private function renderView()
    {
        $button = [
            'listSitPage' => [
                'menu_controller' => 'list-situation-page',
                'menu_metodo' => 'list-situation-pages']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonSitPage'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $loadView = new \Config\ConfigView("administrative/Views/situationPage"
                . "/registerNewSituationPage", $this->dados);
        $loadView->renderView();
    }
}
