<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ViewInfoArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ViewInfoArticle
{
    private $dados;
    private $dadoId;
    public function detailInfoArticle($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $viewArticle = new \Module\site\Models\StsViewInfoArticle();
            $this->dados['infoArticle'] = $viewArticle->viewInfoArticle($this->dadoId);
            $button = [
                'listArticle' => [
                    'menu_controller' => 'list-article',
                    'menu_metodo' => 'list-info-article'],
                'editArticle' => [
                    'menu_controller' => 'edit-article',
                    'menu_metodo' => 'edit-info-article'],
                'editAuthorArticle' => [
                    'menu_controller' => 'edit-author-article',
                    'menu_metodo' => 'edit-info-author-article'],
                'deleteArticle' => [
                    'menu_controller' => 'delete-article',
                    'menu_metodo' => 'remove-article']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsArticle'] = $listButton->validateButton($button);
            
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();

            $loadView = new \Config\ConfigView(
                    "site/Views/article/viewInfoArticle",
                    $this->dados
            );
            $loadView->renderView();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Artigo"
                    . " não encontrado.</div>";
            $urlRedirect = URLADM . 'list-article/list-info-article';
            header("Location: $urlRedirect");
        }
    }
}
