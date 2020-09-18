<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Permission
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class Permission
{
    private $dados;
    private $pageId;
    private $levelId;
    
    public function listPermission($pageId = null)
    {
        $this->pageId = (int) $pageId ? $pageId : 1;
        $this->dados['pg'] = $this->pageId;
        $this->levelId = filter_input(INPUT_GET, "level", FILTER_SANITIZE_NUMBER_INT);
        
        $button = [
            'listLevAc' => [
                'menu_controller' => 'access-level',
                'menu_metodo' => 'list-access'],
            'editPermis' => [
                'menu_controller' => 'edit-permission',
                'menu_metodo' => 'edit-ordem-permission'],
            'ordemPermis' => [
                'menu_controller' => 'move-permission',
                'menu_metodo' => 'move-ordem-permission'],
            'listPermission' => [
                'menu_controller' => 'release-permission',
                'menu_metodo' => 'liberate-permission'],
            'libMenu' => [
                'menu_controller' => 'release-menu',
                'menu_metodo' => 'liberate-menu'],
            'libDropdown' => [
                'menu_controller' => 'release-dropdown',
                'menu_metodo' => 'liberate-dropdown'],
            'orderMenu' => [
                'menu_controller' => 'modify-order-menu',
                'menu_metodo' => 'alter-order-menu'],
            'editItemMenu' => [
                'menu_controller' => 'edit-level-access-page-menu',
                'menu_metodo' => 'edit-access-pg-menu']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonAcesso'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $listPerm = new \Module\administrative\Models\AdmsPermission();
        $this->dados['listPerm'] = $listPerm->listPermission($this->pageId, $this->levelId);
        $this->dados['pagination'] = $listPerm->getResutPage();
        $this->dados['levelAcess'] = $listPerm->viewLevelAccess($this->levelId);
        
        $loadView = new \Config\ConfigView("administrative/Views/permission/listPermission", $this->dados);
        $loadView->renderView();
    }
}
