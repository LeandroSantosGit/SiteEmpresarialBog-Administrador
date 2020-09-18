<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ListArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ListArticle
{
    private $dados;
    private $pageId;
    
    public function listInfoArticle($pageId = null)
    {
        $this->pageId = (int) $pageId ? $pageId : 1;
        $button = [
            'cadArticle' => [
                'menu_controller' => 'register-new-article',
                'menu_metodo' => 'register-info-article'],
            'viewArticle' => [
                'menu_controller' => 'view-info-article',
                'menu_metodo' => 'detail-info-article'],
            'editArticle' => [
                'menu_controller' => 'edit-article',
                'menu_metodo' => 'edit-info-article'],
            'deleteArticle' => [
                'menu_controller' => 'delete-article',
                'menu_metodo' => 'remove-article'],
            'alterSitArticle' => [
                'menu_controller' => 'modify-sit-article',
                'menu_metodo' => 'alter-sit-article']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsArticle'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $listArticle = new \Module\site\Models\StsListArticle();
        $this->dados['listArticle'] = $listArticle->listArticle($this->pageId);
        $this->dados['pagination'] = $listArticle->getResultPg();
        
        $loadView = new \Config\ConfigView(
                "site/Views/article/listArticle",
                $this->dados
        );
        $loadView->renderView();
    }
}
