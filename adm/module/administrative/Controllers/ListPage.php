<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ListPage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ListPage
{
    private $dados;
    private $pageId;
    
    public function listPages($pageId = null)
    {
        $this->pageId = (int) $pageId ? $pageId : 1;
        
        $button = [
            'cadPage' => [
                'menu_controller' => 'register-new-page',
                'menu_metodo' => 'register-info-page'],
            'viewPage' => [
                'menu_controller' => 'view-info-page',
                'menu_metodo' => 'detail-info-page'],
            'editPage' => [
                'menu_controller' => 'edit-page',
                'menu_metodo' => 'edit-info-page'],
            'deletePage' => [
                'menu_controller' => 'delete-page',
                'menu_metodo' => 'remove-page']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonAcesso'] = $listButton->validateButton($button);

        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $listInfoPages = new \Module\administrative\Models\AdmsListPages();
        $this->dados['listPage'] = $listInfoPages->listPages($this->pageId);
        $this->dados['pagination'] = $listInfoPages->getResultPage();
        
        $loadView = new \Config\ConfigView("administrative/Views/page/listPages", $this->dados);
        $loadView->renderView();
    }
}
