<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of RegisterNewSituation
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class RegisterNewSituation
{
    private $dados;
    
    public function registerInfoSituation()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['registerSituation'])) {
            unset($this->dados['registerSituation']);
            $addSituation = new \Module\administrative\Models\AdmsRegisterNewSituation();
            $addSituation->registerSituation($this->dados);
            if ($addSituation->getResult()) {
                $urlRedirect = URLADM . 'list-situation/list-situations';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
        }
        return $this->renderView();
    }
    
    private function renderView()
    {
        $listSelect = new \Module\administrative\Models\AdmsRegisterNewSituation();
        $this->dados['select'] = $listSelect->listSituation();
        
        $button = [
            'listSit' => [
                'menu_controller' => 'list-situation',
                'menu_metodo' => 'list-situations']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsSituation'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $loadView = new \Config\ConfigView("administrative/Views/situation/registerNewSituation", $this->dados);
        $loadView->renderView();
    }
}
