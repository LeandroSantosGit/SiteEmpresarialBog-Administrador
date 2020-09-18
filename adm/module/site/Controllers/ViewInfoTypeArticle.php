<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ViewInfoTypeArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ViewInfoTypeArticle
{
    private $dadoId;
    private $dados;
    
    public function detailInfoTypeArticle($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $viewTpArticle = new \Module\site\Models\StsViewInfoTypeArticle();
            $this->dados['infoTypeArticle'] = $viewTpArticle->viewInfoTypeArticle($this->dadoId);
            
            $button = [
                'listTypeArticle' => [
                    'menu_controller' => 'list-type-article',
                    'menu_metodo' => 'list-info-type-article'],
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

            $loadView = new \Config\ConfigView(
                    "site/Views/typeArticle/viewInfoTypeArticle",
                    $this->dados
            );
            $loadView->renderView();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Tipo de artigo"
                    . " não encontrado.</div>";
            $urlRedirect = URLADM . 'list-type-article/list-info-type-article';
            header("Location: $urlRedirect");
        }
    }
}
