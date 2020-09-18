<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit(); 
}

/**
 * Description of Profile
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class Profile
{
    private $dados;
    
    public function profileUser()
    {
        $profileUser = new \Module\administrative\Models\AdmsProfile();
        $this->dados['dadosProfile'] = $profileUser->profileUserModel();
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $loadView = new \Config\ConfigView("administrative/Views/user/profile", $this->dados);
        $loadView->renderView();
    }
}
