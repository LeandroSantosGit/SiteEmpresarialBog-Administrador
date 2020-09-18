<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location");
    exit();
}

/**
 * Description of RegisterLevelAccess
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class RegisterLevelAccess
{
    private $dados;
    
    public function registerAccess()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['registerAccess'])) {
            unset($this->dados['registerAccess']);
            $addAccess = new \Module\administrative\Models\AdmsRegisterLevelAccess();
            $addAccess->addLevelAccess($this->dados);
            if ($addAccess->getResult()) {
                $urlRedirect = URLADM . 'access-level/list-access';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
        }
        $this->renderView();
    }
    
    private function renderView()
    {
        $button = [
            'listAcess' => [
                'menu_controller' => 'access-level',
                'menu_metodo' => 'list-access']  
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonAcesso'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $loadView = new \Config\ConfigView("administrative/Views/levelAccess/registerLevelAccess", $this->dados);
        $loadView->renderView();
    }
}
