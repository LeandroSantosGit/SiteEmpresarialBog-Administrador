<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ListSobCompany
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ListSobCompany
{
    private $dados;
    private $pageId;
    
    public function listInfoCompany($pageId = null)
    {
        $this->pageId = (int) $pageId ? $pageId : 1;
        $button = [
            'cadSobCompany' => [
                'menu_controller' => 'register-new-sob-company',
                'menu_metodo' => 'register-info-sob-company'],
            'viewSobCompany' => [
                'menu_controller' => 'view-info-sob-company',
                'menu_metodo' => 'detail-info-sob-company'],
            'editSobCompany' => [
                'menu_controller' => 'edit-sob-company',
                'menu_metodo' => 'edit-info-sob-company'],
            'deleteSobCompany' => [
                'menu_controller' => 'delete-sob-company',
                'menu_metodo' => 'remove-sob-company'],
            'alterOrderSobCompany' => [
                    'menu_controller' => 'modify-order-sob-company',
                    'menu_metodo' => 'alter-order-sob-company'],
            'alterSitSobCompany' => [
                'menu_controller' => 'modify-situation-sob-company',
                'menu_metodo' => 'alter-situation-sob-company']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsSobCompany'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $listSobCompany = new \Module\site\Models\StsListSobCompany();
        $this->dados['listSobCompany'] = $listSobCompany->listInfoSobCompany($this->pageId);
        $this->dados['pagination'] = $listSobCompany->getResultPg();
        
        $loadView = new \Config\ConfigView("site/Views/sobCompany/listSobCompany",$this->dados);
        $loadView->renderView();
    }
}
