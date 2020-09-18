<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of RegisterNewPageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class RegisterNewPageSite
{
    private $dados;
    
    public function registerInfoPageSite()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        IF (!empty($this->dados['registerNewPageSite'])) {
            unset($this->dados['registerNewPageSite']);
            $this->dados['imageNew'] = ($_FILES['imageNew'] ? $_FILES['imageNew'] : null);
            $addPage = new \Module\site\Models\StsRegisterNewPageSite();
            $addPage->registerPageSite($this->dados);
            if ($addPage->getResult()) {
                $urlRedirect = URLADM . 'list-page-site/list-info-page-site';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        return $this->renderView();
    }
    
    private function renderView()
    {
        $listSelect = new \Module\site\Models\StsRegisterNewPageSite();
        $this->dados['select'] = $listSelect->listPageSite();
        
        $button = [
            'listPage' => [
                'menu_controller' => 'list-page-site',
                'menu_metodo' => 'list-info-page-site']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsPage'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $loadView = new \Config\ConfigView("site/Views/page/registerNewPageSite", $this->dados);
        return $loadView->renderView();
    }
}
