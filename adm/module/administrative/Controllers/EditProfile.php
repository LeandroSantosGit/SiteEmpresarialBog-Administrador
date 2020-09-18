<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditProfile
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditProfile
{
    private $dados;
    
    public function editProfileUser()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['editProfileUser'])) {
            unset($this->dados['editProfileUser']);
            $this->dados['imageNew'] = ($_FILES['imageNew'] ? $_FILES['imageNew'] : null);
            $editProfile = new \Module\administrative\Models\AdmsEditProfile();
            $editProfile->AdmsEditProfileUser($this->dados);
            if ($editProfile->getResult()) {
                $urlRedirect = URLADM . 'profile/profile-user';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->modifyPerfilUser();
        }
        $profileUser = new \Module\administrative\Models\AdmsProfile();
        $this->dados['form'] = $profileUser->profileUserModel();
        return $this->modifyPerfilUser();
    }
    
    private function modifyPerfilUser()
    {
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $loadView = new \Config\ConfigView("administrative/Views/user/editProfile", $this->dados);
        return $loadView->renderView();
    }
}
