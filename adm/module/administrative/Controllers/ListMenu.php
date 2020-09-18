<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ListMenu
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ListMenu
{
    private $dados;
    private $pageId;
    
    public function listItensMenu($pageId = null)
    {
        $this->pageId = (int) $pageId ? $pageId : 1;
        
        $button = [
            'cadMenu' => [
                'menu_controller' => 'register-new-menu',
                'menu_metodo' => 'register-info-menu'],
            'viewMenu' => [
                'menu_controller' => 'view-info-menu',
                'menu_metodo' => 'detail-info-menu'],
            'editMenu' => [
                'menu_controller' => 'edit-menu',
                'menu_metodo' => 'edit-info-menu'],
            'deleteMenu' => [
                'menu_controller' => 'delete-menu',
                'menu_metodo' => 'remove-menu'],
            'alterOrderMenu' => [
                'menu_controller' => 'modify-order-item-menu',
                'menu_metodo' => 'alter-order-item-menu']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsMenu'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $listItemMenu = new \Module\administrative\Models\AdmsListMenu();
        $this->dados['listItensMenu'] = $listItemMenu->listItensMenu($this->pageId);
        $this->dados['pagination'] = $listItemMenu->getResultPage();
        
        $loadView = new \Config\ConfigView("administrative/Views/menu/listMenu", $this->dados);
        $loadView->renderView();
    }
}
