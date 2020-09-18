<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditUser
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditUser
{
    private $dados;
    private $dadoId;
    
    public function editInfoUser($dadoId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $this->editUserPrivate();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Usuário não encontrado.</div>";
            $urlRedirect = URLADM . 'users/list-users';
            header("Location: $urlRedirect");
        }
    }
    
    private function editUserPrivate()
    {
        if (!empty($this->dados['editInfoUser'])) {
            unset($this->dados['editInfoUser']);
            $this->dados['imageNew'] = ($_FILES['imageNew'] ? $_FILES['imageNew'] : null);
            $editUser = new \Module\administrative\Models\AdmsEditUser();
            $editUser->AdmsEditUser($this->dados);
            if ($editUser->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Usuário alterada com sucesso.</div>";
                $urlRedirect = URLADM . 'view-info-user/detail-info-user/' . $this->dados['id'];
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoUser = new \Module\administrative\Models\AdmsEditUser();
        $this->dados['form'] = $infoUser->viewInfoUser($this->dadoId);
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $listSelect = new \Module\administrative\Models\AdmsEditUser();
            $this->dados['select'] = $listSelect->listRegister();
            
            $button = 
            ['viewUser' => [
                'menu_controller' => 'view-info-user',
                'menu_metodo' => 'detail-info-user']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonAcesso'] = $listButton->validateButton($button);

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView("administrative/Views/user/editUser", $this->dados);
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Usuário não encontrado.</div>";
        $urlRedirect = URLADM . 'users/list-users';
        return header("Location: $urlRedirect");
    }
}
