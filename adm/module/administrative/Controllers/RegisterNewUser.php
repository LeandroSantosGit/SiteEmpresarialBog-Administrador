<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of RegisterNewUser
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class RegisterNewUser
{
    private $dados;
    
    public function registerInfoUser()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['registerNewUser'])) {
            unset($this->dados['registerNewUser']);
            $this->dados['imageNew'] = ($_FILES['imageNew'] ? $_FILES['imageNew'] : null);
            $addUser = new \Module\administrative\Models\AdmsRegisterNewUser();
            $addUser->addNewUser($this->dados);
            if ($addUser->getResult()) {
                $urlRedirect = URLADM . 'users/list-users';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        return $this->renderView();
    }
    
    private function renderView()
    {
        $listSelect = new \Module\administrative\Models\AdmsRegisterNewUser();
        $this->dados['select'] = $listSelect->listRegister();
        
        $button = [
            'listUser' => [
                'menu_controller' => 'users',
                'menu_metodo' => 'list-users']  
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonAcesso'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $loadView = new \Config\ConfigView("administrative/Views/user/registerNewUser", $this->dados);
        return $loadView->renderView();
    }
}
