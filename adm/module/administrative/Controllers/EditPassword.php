<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditPassword
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditPassword
{
    private $dados;
    private $dadoId;
    
    public function editPass($dadoId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            return $this->checkKey();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Usuário não encontrado.</div>";
        $urlRedirect = URLADM . 'users/list-users';
        return header("Location: $urlRedirect");
    }
    
    /* verificar se a chave de recuperar senha é valida */
    private function checkKey()
    {
        $validUser = new \Module\administrative\Models\AdmsEditPasssword();
        $validUser->validateUser($this->dadoId);
        if ($validUser->getResult()) {
            return $this->editPassPrivate();
        }
        $urlRedirect = URLADM . 'users/list-users';
        return header("Location: $urlRedirect");
    }
    
    private function editPassPrivate()
    {
        if (!empty($this->dados['editPassUser'])) {
            unset($this->dados['editPassUser']);
            $editPass = new \Module\administrative\Models\AdmsEditPasssword();
            $editPass->editPassModel($this->dados);
            if ($editPass->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Senha alterada com sucesso.</div>";
                $urlRedirect = URLADM . 'view-info-user/detail-info-user/' . $this->dados['id'];
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados['id'];
            return $this->renderView();
        }
        $this->dados['form'] = $this->dadoId;
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            
            $button = 
            ['viewUser' => [
                'menu_controller' => 'view-info-user',
                'menu_metodo' => 'detail-info-user']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonAcesso'] = $listButton->validateButton($button);
            
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView("administrative/Views/user/editPassword", $this->dados);
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Usuário não encontrado.</div>";
        $urlRedirect = URLADM . 'users/list-users';
        return header("Location: $urlRedirect");
    }
}
