<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ListTypePage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ListTypePage
{
    private $dados;
    private $pageId;
    
    public function listTypesPages($pageId = null)
    {
        $this->pageId = (int) $pageId ? $pageId : 1;
        
        $button = [
            'cadTypPage' => [
                'menu_controller' => 'register-new-type-page',
                'menu_metodo' => 'register-info-type-page'],
            'viewTypPage' => [
                'menu_controller' => 'view-info-type-page',
                'menu_metodo' => 'detail-info-type-page'],
            'editTypPage' => [
                'menu_controller' => 'edit-type-page',
                'menu_metodo' => 'edit-info-type-page'],
            'deleteTypPage' => [
                'menu_controller' => 'delete-type-page',
                'menu_metodo' => 'remove-type-page'],
            'alterOrderTypPage' => [
                'menu_controller' => 'modify-order-type-page',
                'menu_metodo' => 'alter-order-type-page']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsTypPage'] = $listButton->validateButton($button);

        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $listInfoTypPg = new \Module\administrative\Models\AdmsListTypePage();
        $this->dados['listTypPage'] = $listInfoTypPg->listPages($this->pageId);
        $this->dados['pagination'] = $listInfoTypPg->getResultPage();
        
        $loadView = new \Config\ConfigView("administrative/Views/typePage/listTypePage", $this->dados);
        $loadView->renderView();
    }
}
