<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of RegisterNewColor
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class RegisterNewColor
{
    private $dados;
    
    public function registerInfoColor()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['registerNewColor'])) {
            unset($this->dados['registerNewColor']);
            $addColor = new \Module\administrative\Models\AdmsRegisterNewColor();
            $addColor->registerColor($this->dados);
            if ($addColor->getResult()) {
                $urlRedirect = URLADM . 'list-color/list-colors';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
        }
        return $this->renderView();
    }
    
    private function renderView()
    {
        $button = [
            'listColor' => [
                'menu_controller' => 'list-color',
                'menu_metodo' => 'list-colors']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsColor'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $loadView = new \Config\ConfigView("administrative/Views/colors/registerNewColor", $this->dados);
        $loadView->renderView();
    }
}
