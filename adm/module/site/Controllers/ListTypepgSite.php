<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ListTypepgSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ListTypepgSite
{
    private $dados;
    private $pageId;
    
    public function listInfoTypepgSite($pageId = null)
    {
        $this->pageId = (int) $pageId ? $pageId : 1;
        $button = [
            'cadTypePg' => [
                'menu_controller' => 'register-new-typepg-site',
                'menu_metodo' => 'register-info-typepg-site'],
            'viewTypePg' => [
                'menu_controller' => 'view-info-typepg-site',
                'menu_metodo' => 'detail-info-typepg-site'],
            'editTypePg' => [
                'menu_controller' => 'edit-typepg-site',
                'menu_metodo' => 'edit-info-typepg-site'],
            'deleteTypePg' => [
                'menu_controller' => 'delete-typepg-site',
                'menu_metodo' => 'remove-typepg-site'],
            'alterOrderTypePg' => [
                'menu_controller' => 'modify-order-typepg-site',
                'menu_metodo' => 'alter-order-typepg-site']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsTypePg'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $listTypePage = new \Module\site\Models\StsListTypepgSite();
        $this->dados['listTypePg'] = $listTypePage->listInfoTypePageSite($this->pageId);
        $this->dados['pagination'] = $listTypePage->getResultPg();
        
        $loadView = new \Config\ConfigView(
                "site/Views/typePageSite/listTypepgSite",
                $this->dados
        );
        $loadView->renderView();
    }
}
