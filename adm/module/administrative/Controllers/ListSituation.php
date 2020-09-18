<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ListSituation
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ListSituation
{
    private $dados;
    private $pageId;
    
    public function listsituations($pageId = null)
    {
        $this->pageId = (int) $pageId ? $pageId : 1;
        
        $button = [
            'cadSit' => [
                'menu_controller' => 'register-new-situation',
                'menu_metodo' => 'register-info-situation'],
            'viewSit' => [
                'menu_controller' => 'view-info-situation',
                'menu_metodo' => 'detail-info-situation'],
            'editSit' => [
                'menu_controller' => 'edit-situation',
                'menu_metodo' => 'edit-info-situation'],
            'deleteSit' => [
                'menu_controller' => 'delete-situation',
                'menu_metodo' => 'remove-situation'],
            'alterOrderSit' => [
                'menu_controller' => 'modify-order-situation',
                'menu_metodo' => 'alter-order-situation']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsSituation'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $listSituation = new \Module\administrative\Models\AdmsListSituation();
        $this->dados['listSit'] = $listSituation->listSituations($this->pageId);
        $this->dados['pagination'] = $listSituation->getResultPg();
        
        $loadView = new \Config\ConfigView("administrative/Views/situation/listSituation", $this->dados);
        $loadView->renderView();
    }
}
