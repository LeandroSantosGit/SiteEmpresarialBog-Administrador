<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ListSituationPage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ListSituationPage
{
    private $pageId;
    private $dados;
    
    public function listSituationPages($pageId = null)
    {
        $this->pageId = (int) $pageId ? $pageId : 1;
        $button = [
            'cadSitPage' => [
                'menu_controller' => 'register-new-situation-page',
                'menu_metodo' => 'register-info-situation-page'],
            'viewSitPage' => [
                'menu_controller' => 'view-info-situation-page',
                'menu_metodo' => 'detail-info-situation-page'],
            'editSitPage' => [
                'menu_controller' => 'edit-situation-page',
                'menu_metodo' => 'edit-info-situation-page'],
            'deleteSitPage' => [
                'menu_controller' => 'delete-situation-page',
                'menu_metodo' => 'remove-situation-page']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonSitPage'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $listSitPg = new \Module\administrative\Models\AdmsListSituationPage();
        $this->dados['listSitPage'] = $listSitPg->listSituationPages($this->pageId);
        $this->dados['pagination'] = $listSitPg->getResultPg();
        
        $loadView = new \Config\ConfigView("administrative/Views/situationPage/listSituationPage", $this->dados);
        $loadView->renderView();
    }
}
