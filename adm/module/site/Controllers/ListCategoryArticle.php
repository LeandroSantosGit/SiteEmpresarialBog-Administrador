<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ListCategoryArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ListCategoryArticle
{
    private $dados;
    private $pageId;
    
    public function listInfoCategoryArticle($pageId = null)
    {
        $this->pageId = (int) $pageId ? $pageId : 1;
        $button = [
            'cadCatArticle' => [
                'menu_controller' => 'register-new-category-article',
                'menu_metodo' => 'register-info-category-article'],
            'viewCatArticle' => [
                'menu_controller' => 'view-info-category-article',
                'menu_metodo' => 'detail-info-category-article'],
            'editCatArticle' => [
                'menu_controller' => 'edit-category-article',
                'menu_metodo' => 'edit-info-category-article'],
            'deleteCatArticle' => [
                'menu_controller' => 'delete-category-article',
                'menu_metodo' => 'remove-category-article'],
            'alterSitCatArticle' => [
                'menu_controller' => 'modify-sit-category-article',
                'menu_metodo' => 'alter-sit-category-article']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsCatArticle'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $listCatArticle = new \Module\site\Models\StsListCategoryArticle();
        $this->dados['listCatArticle'] = $listCatArticle->listCategoryArticle($this->pageId);
        $this->dados['pagination'] = $listCatArticle->getResultPg();
        
        $loadView = new \Config\ConfigView(
                "site/Views/categoryArticle/listCategoryArticle",
                $this->dados
        );
        $loadView->renderView();
    }
}
