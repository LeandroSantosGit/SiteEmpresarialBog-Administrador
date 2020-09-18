<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ViewInfoCategoryArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ViewInfoCategoryArticle
{
    private $dados;
    private $dadoId;
    
    public function detailInfoCategoryArticle($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $viewCatArticle = new \Module\site\Models\StsViewInfoCategoryArticle();
            $this->dados['infoCatArticle'] = $viewCatArticle->viewCategoryArticle($this->dadoId);
            
            $button = [
                'listCatArticle' => [
                    'menu_controller' => 'list-category-article',
                    'menu_metodo' => 'list-info-category-article'],
                'editCatArticle' => [
                    'menu_controller' => 'edit-category-article',
                    'menu_metodo' => 'edit-info-category-article'],
                'deleteCatArticle' => [
                    'menu_controller' => 'delete-category-article',
                    'menu_metodo' => 'remove-category-article']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsCatArticle'] = $listButton->validateButton($button);
            
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();

            $loadView = new \Config\ConfigView(
                    "site/Views/categoryArticle/viewInfoCategoryArticle",
                    $this->dados
            );
            $loadView->renderView();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Categoria de "
                    . "artigo não encontrado.</div>";
            $urlRedirect = URLADM . 'list-category-article/list-info-category-article';
            header("Location: $urlRedirect");
        }
    }
}
