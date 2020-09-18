<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AccessLevel
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AccessLevel
{
    private $dados;
    private $pageId;
    
    public function listAccess($pageId = null)
    {
        $this->pageId = (int) $pageId ? $pageId : 1;
        
        $button = [
            'cadAcess' => [
                'menu_controller' => 'register-level-access',
                'menu_metodo' => 'register-access'],
            'viewAcess' => [
                'menu_controller' => 'view-level-access',
                'menu_metodo' => 'detail-access'],
            'editAcess' => [
                'menu_controller' => 'edit-level-access',
                'menu_metodo' => 'edit-access'],
            'deleteAcess' => [
                'menu_controller' => 'delete-level-access',
                'menu_metodo' => 'remove-acess'],
            'ordemLevelAcess' => [
                'menu_controller' => 'modify-order-access',
                'menu_metodo' => 'modify-orderAcc'],
            'listPermission' => [
                'menu_controller' => 'permission',
                'menu_metodo' => 'list-permission'],
            'synchronizePerm' => [
                'menu_controller' => 'synchronize-level-access-page',
                'menu_metodo' => 'synchronize-access-pg']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonAcesso'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $listNivAce = new \Module\administrative\Models\AdmsAccessLevel();
        $this->dados['listNivAc'] = $listNivAce->listStatusAccess($this->pageId);
        $this->dados['pagination'] = $listNivAce->getResultPage();
        
        $loadView = new \Config\ConfigView("administrative/Views/levelAccess/listAccessLevel", $this->dados);
        $loadView->renderView();
    }
}
