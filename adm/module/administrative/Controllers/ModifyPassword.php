<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ModifyPassword
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ModifyPassword
{
    private $dados;
    
    public function modifyPass()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['modifyPassUser'])) {
            unset($this->dados['modifyPassUser']);
            $modifyPassUser = new \Module\administrative\Models\AdmsModifyPassword();
            $modifyPassUser->AdmsModifyPassUser($this->dados);
            if ($modifyPassUser->getResult()) {
                $urlRedirect = URLADM . 'profile/profile-user';
                header("Location: $urlRedirect");
            }
        }
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();

        $loadView = new \Config\ConfigView("administrative/Views/user/modifyPassword", $this->dados);
        return $loadView->renderView();
    }
}
