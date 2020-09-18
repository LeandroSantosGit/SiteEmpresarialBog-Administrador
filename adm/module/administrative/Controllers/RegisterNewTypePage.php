<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of RegisterNewTypePage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class RegisterNewTypePage
{
    private $dados;
    
    public function registerInfoTypePage()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['registerTypePage'])) {
            unset($this->dados['registerTypePage']);
            $addTypePg = new \Module\administrative\Models\AdmsRegisterNewTypePage();
            $addTypePg->registerTypePage($this->dados);
            if ($addTypePg->getResult()) {
                $urlRedirect = URLADM . 'list-type-page/list-types-pages';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
        }
        return $this->renderView();
    }
    
    private function renderView()
    {
        $button = [
            'listTypPage' => [
                'menu_controller' => 'list-type-page',
                'menu_metodo' => 'list-types-pages']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsTypPage'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $loadView = new \Config\ConfigView("administrative/Views/typePage/registerNewTypePage", $this->dados);
        $loadView->renderView();
    }
}
