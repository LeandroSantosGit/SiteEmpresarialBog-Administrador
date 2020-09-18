<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of RegisterNewSitpageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class RegisterNewSitpageSite
{
    private $dados;
    
    public function registerInfoSitpageSite()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['registerSitPageSite'])) {
            unset($this->dados['registerSitPageSite']);
            $addSituationPage = new \Module\site\Models\StsRegisterNewSitpageSite();
            $addSituationPage->registerSituationPageSite($this->dados);
            if ($addSituationPage->getResult()) {
                $urlRedirect = URLADM . 'list-sitpage-site/list-info-sitpage-site';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        return $this->renderView();
    }
    
    private function renderView()
    {
        $listSelect = new \Module\site\Models\StsRegisterNewSitpageSite();
        $this->dados['select'] = $listSelect->listSituationPageSite();
        
        $button = [
            'listSitPage' => [
                'menu_controller' => 'list-sitpage-site',
                'menu_metodo' => 'list-info-sitpage-site']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsSitPage'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $loadView = new \Config\ConfigView(
                "site/Views/situationPageSite/registerNewSitpageSite",
                $this->dados
        );
        return $loadView->renderView();
    }
}
