<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ListGroupPage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ListGroupPage
{
    private $dados;
    private $pageId;
    
    public function listGroupsPages($pageId = null)
    {
        $this->pageId = (int) $pageId ? $pageId : 1;
        
        $button = [
            'cadGrupPg' => [
                'menu_controller' => 'register-new-group-pg',
                'menu_metodo' => 'register-info-group-pg'],
            'viewGrupPg' => [
                'menu_controller' => 'view-info-group-pg',
                'menu_metodo' => 'detail-info-group-pg'],
            'editGrupPg' => [
                'menu_controller' => 'edit-group-pg',
                'menu_metodo' => 'edit-info-group-pg'],
            'deleteGrupPg' => [
                'menu_controller' => 'delete-group-pg',
                'menu_metodo' => 'remove-group-pg'],
            'alterOrderGrupPg' => [
                'menu_controller' => 'modify-order-group-pg',
                'menu_metodo' => 'alter-order-group-pg']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsGrupPg'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $listGroupPg = new \Module\administrative\Models\AdmsListGroupPage();
        $this->dados['listGrupPg'] = $listGroupPg->listGrupPage($this->pageId);
        $this->dados['pagination'] = $listGroupPg->getResultPage();
        
        $loadView = new \Config\ConfigView("administrative/Views/groupPage/listGroupPage", $this->dados);
        $loadView->renderView();
    }
}
