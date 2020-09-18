<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ListPageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ListPageSite
{
    private $dados;
    private $pageId;
    
    public function listInfoPageSite($pageId = null)
    {
        $this->pageId = (int) $pageId ? $pageId : 1;
        $button = [
            'cadPage' => [
                'menu_controller' => 'register-new-page-site',
                'menu_metodo' => 'register-info-page-site'],
            'viewPage' => [
                'menu_controller' => 'view-info-page-site',
                'menu_metodo' => 'detail-info-page-site'],
            'editPage' => [
                'menu_controller' => 'edit-page-site',
                'menu_metodo' => 'edit-info-page-site'],
            'deletePage' => [
                'menu_controller' => 'delete-page-site',
                'menu_metodo' => 'remove-page-site'],
            'alterSitPage' => [
                'menu_controller' => 'modify-sit-page-site',
                'menu_metodo' => 'alter-sit-page-site'],
            'alterOrderPage' => [
                'menu_controller' => 'modify-order-page-site',
                'menu_metodo' => 'alter-order-page-site'],
            'alterPermissonPage' => [
                'menu_controller' => 'modify-permission-page-site',
                'menu_metodo' => 'alter-permission-page-site']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsPage'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $listTypePage = new \Module\site\Models\StsListPageSite();
        $this->dados['listPage'] = $listTypePage->listPagesSite($this->pageId);
        $this->dados['pagination'] = $listTypePage->getResultPg();
        
        $loadView = new \Config\ConfigView(
                "site/Views/page/listPageSite",
                $this->dados
        );
        $loadView->renderView();
    }
}
