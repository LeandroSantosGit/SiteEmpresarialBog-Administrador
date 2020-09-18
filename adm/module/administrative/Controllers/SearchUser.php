<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of SearchUser
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class SearchUser
{
    private $dados;
    private $pageId;
    private $dadosForm;
    
    public function listUsersSearched($pageId = null)
    {
        $button = [
            'listUser' => [
                'menu_controller' => 'users',
                'menu_metodo' => 'list-users'],
            'cadUser' => [
                'menu_controller' => 'register-new-user',
                'menu_metodo' => 'register-info-user'],
            'viewUser' => [
                'menu_controller' => 'view-info-user',
                'menu_metodo' => 'detail-info-user'],
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
        
        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dadosForm['searchUserRegistration'])) {
            unset($this->dadosForm['searchUserRegistration']);
        } else {
            $this->pageId = (int) $pageId ? $pageId : 1;
            $this->dadosForm['nome'] = filter_input(INPUT_GET, 'nome', FILTER_DEFAULT);
            $this->dadosForm['email'] = filter_input(INPUT_GET, 'email', FILTER_DEFAULT);
        }
        $listUser = new \Module\administrative\Models\AdmsSearchUser();
        $this->dados['listUser'] = $listUser->listSearchedUser(
                $this->pageId,
                $this->dadosForm
        );
        $this->dados['pagination'] = $listUser->getResultPage();
        
        $loadView = new \Config\ConfigView(
                "administrative/Views/user/searchUser",
                $this->dados
        );
        $loadView->renderView();
    }
}
