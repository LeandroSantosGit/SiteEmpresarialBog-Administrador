<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of RegisterNewSituationUser
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class RegisterNewSituationUser
{
    private $dados;
    
    public function registerInfoSituationUser()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['registerSitUser'])) {
            unset($this->dados['registerSitUser']);
            $addSitUser = new \Module\administrative\Models\AdmsRegisterNewSituationUser();
            $addSitUser->registerSituationUser($this->dados);
            if ($addSitUser->getResult()) {
                $urlRedirect = URLADM . 'list-situation-user/list-situation-users';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
        }
        return $this->renderView();
    }
    
    private function renderView()
    {
        $listSelect = new \Module\administrative\Models\AdmsRegisterNewSituationUser();
        $this->dados['select'] = $listSelect->listSituationUser();
        
        $button = [
            'listSitUser' => [
                'menu_controller' => 'list-situation-user',
                'menu_metodo' => 'list-situation-users']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonSitUser'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $loadView = new \Config\ConfigView("administrative/Views/situationUser/registerNewSituationUser", $this->dados);
        $loadView->renderView();
    }
}
