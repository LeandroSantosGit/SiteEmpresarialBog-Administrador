<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ListTypeArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ListTypeArticle
{
    private $dados;
    private $pageId;
    
    public function listInfoTypeArticle($pageId = null)
    {
        $this->pageId = (int) $pageId ? $pageId : 1;
        $button = [
            'cadTypeArticle' => [
                'menu_controller' => 'register-new-type-article',
                'menu_metodo' => 'register-info-type-article'],
            'viewTypeArticle' => [
                'menu_controller' => 'view-info-type-article',
                'menu_metodo' => 'detail-info-type-article'],
            'editTypeArticle' => [
                'menu_controller' => 'edit-type-article',
                'menu_metodo' => 'edit-info-type-article'],
            'deleteTypeArticle' => [
                'menu_controller' => 'delete-type-article',
                'menu_metodo' => 'remove-type-article']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsTypeArticle'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $listTpArticle = new \Module\site\Models\StsListTypeArticle();
        $this->dados['listTypeArticle'] = $listTpArticle->listTypeArticle($this->pageId);
        $this->dados['pagination'] = $listTpArticle->getResultPg();
        
        $loadView = new \Config\ConfigView(
                "site/Views/typeArticle/listTypeArticle",
                $this->dados
        );
        $loadView->renderView();
    }
}
