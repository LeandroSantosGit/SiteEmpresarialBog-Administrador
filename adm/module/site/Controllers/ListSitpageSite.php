<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ListSitpageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ListSitpageSite
{
    private  $dados;
    private $pageId;
    
    public function listInfoSitpageSite($pageId = null)
    {
        $this->pageId = (int) $pageId ? $pageId : 1;
        $button = [
            'cadSitPage' => [
                'menu_controller' => 'register-new-sitpage-site',
                'menu_metodo' => 'register-info-sitpage-site'],
            'viewSitPage' => [
                'menu_controller' => 'view-info-sitpage-site',
                'menu_metodo' => 'detail-info-sitpage-site'],
            'editSitPage' => [
                'menu_controller' => 'edit-sitpage-site',
                'menu_metodo' => 'edit-info-sitpage-site'],
            'deleteSitPage' => [
                'menu_controller' => 'delete-sitpage-site',
                'menu_metodo' => 'remove-sitpage-site']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsSitPage'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $listSitPage = new \Module\site\Models\StsListSitpageSite();
        $this->dados['listSitPage'] = $listSitPage->listSituationPagesSite($pageId);
        $this->dados['pagination'] = $listSitPage->getResultPg();
        
        $loadView = new \Config\ConfigView(
                "site/Views/situationPageSite/listSitpageSite",
                $this->dados
        );
        $loadView->renderView();
    }
}
