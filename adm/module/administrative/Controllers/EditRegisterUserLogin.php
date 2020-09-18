<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditRegisterUserLogin
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditRegisterUserLogin
{
    private $dados;
    
    public function editInfoUserLogin()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['editNewInfoUser'])) {
            unset($this->dados['editNewInfoUser']);
            $editInfoUser = new \Module\administrative\Models\AdmsEditRegisterUserLogin();
            $editInfoUser->alterInfoUser($this->dados);
            if ($editInfoUser->getResult()) {
                $urlRedirect = URLADM . 'edit-register-user-login/edit-info-user-login';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoUser = new \Module\administrative\Models\AdmsEditRegisterUserLogin();
        $this->dados['form'] = $infoUser->viewInforRegisterUser();
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $listSelect = new \Module\administrative\Models\AdmsEditRegisterUserLogin();
            $this->dados['select'] = $listSelect->listRegisterUser();

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView("administrative/Views/user/editRegisterUserLogin", $this->dados);
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Página para editar 
                informações de login do usuário não encontrada.</div>";
        $urlRedirect = URLADM . 'edit-register-user-login/edit-info-user-login';
        return header("Location: $urlRedirect");
    }
}
