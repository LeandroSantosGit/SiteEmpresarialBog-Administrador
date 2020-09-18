<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Users
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class Users
{
    private $dados;
    private $pageId;
    
    public function listUsers($pageId = null)
    {
        $this->pageId = (int) $pageId ? $pageId : 1;
        $button = [
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
        
        $listInfoUsers = new \Module\administrative\Models\AdmsListUsers();
        $this->dados['listUser'] = $listInfoUsers->listUsers($this->pageId);
        $this->dados['pagination'] = $listInfoUsers->getResultPage();
        
        $loadView = new \Config\ConfigView("administrative/Views/user/listUsers", $this->dados);
        $loadView->renderView();
    }
}
