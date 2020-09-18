<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location:");
    exit();
}

/**
 * Description of RegisterNewTypepgSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class RegisterNewTypepgSite
{
    private $dados;
    
    public function registerInfoTypepgSite()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['registerTypePage'])) {
            unset($this->dados['registerTypePage']);
            $addTypePage = new \Module\site\Models\StsRegisterNewTypepgSite();
            $addTypePage->registerTypePageSite($this->dados);
            if ($addTypePage->getResult()) {
                $urlRedirect = URLADM . 'list-typepg-site/list-info-typepg-site';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        return $this->renderView();
    }
    
    private function renderView()
    {
        $button = [
            'listTypePg' => [
                'menu_controller' => 'list-typepg-site',
                'menu_metodo' => 'list-info-typepg-site']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsTypePg'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $loadView = new \Config\ConfigView(
                "site/Views/typePageSite/registerNewTypepgSite",
                $this->dados
        );
        return $loadView->renderView();
    }
}
