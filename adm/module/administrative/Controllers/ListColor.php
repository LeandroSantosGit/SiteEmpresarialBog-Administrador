<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ListColor
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ListColor
{
    private $dados;
    private $pageId;
    
    public function listColors($pageId = null)
    {
        $this->pageId = (int) $pageId;
        
        $button = [
            'cadColor' => [
                'menu_controller' => 'register-new-color',
                'menu_metodo' => 'register-info-color'],
            'viewColor' => [
                'menu_controller' => 'view-info-color',
                'menu_metodo' => 'detail-info-color'],
            'editColor' => [
                'menu_controller' => 'edit-color',
                'menu_metodo' => 'edit-info-color'],
            'deleteColor' => [
                'menu_controller' => 'delete-color',
                'menu_metodo' => 'remove-color']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsColor'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $listColor = new \Module\administrative\Models\AdmsListColor();
        $this->dados['listColors'] = $listColor->listColors($this->pageId);
        $this->dados['pagination'] = $listColor->getResultPg();
        
        $loadView = new \Config\ConfigView("administrative/Views/colors/listColors", $this->dados);
        $loadView->renderView();
    }
}
