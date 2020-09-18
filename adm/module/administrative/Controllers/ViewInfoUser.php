<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ViewInfoUser
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ViewInfoUser
{
    private $dados;
    private $dadoId;


    public function detailInfoUser($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $detailUser = new \Module\administrative\Models\AdmsViewInfoUser();
            $this->dados['infoUser'] = $detailUser->viewInfoUser($this->dadoId);
            
            $button = [
                'listUser' => [
                    'menu_controller' => 'users',
                    'menu_metodo' => 'list-users'],
                'editPass' => [
                    'menu_controller' => 'edit-password',
                    'menu_metodo' => 'edit-pass'],
                'editUser' => [
                    'menu_controller' => 'edit-user',
                    'menu_metodo' => 'edit-info-user'],
                'deleteUser' => [
                    'menu_controller' => 'delete-user',
                    'menu_metodo' => 'remove-user']    
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonAcesso'] = $listButton->validateButton($button);
            
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();

            $loadView = new \Config\ConfigView("administrative/Views/user/viewInfoUser", $this->dados);
            $loadView->renderView();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro, usuário não encontrado.</div>";
            $urlRedirect = URLADM . 'users/list-users';
            header("Location: $urlRedirect");
        }
    }
}
