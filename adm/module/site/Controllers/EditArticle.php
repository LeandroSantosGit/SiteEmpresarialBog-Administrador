<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditArticle
{
    private $dados;
    private $dadoId;
    
    public function editInfoArticle($dadoId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            return $this->editArticle();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Artigo "
                    . "não encontrado.</div>";
        $urlRedirect = URLADM . 'list-article/list-info-article';
        return header("Location: $urlRedirect");
    }
    
    private function editArticle()
    {
        if (!empty($this->dados['editArticle'])) {
            unset($this->dados['editArticle']);
            $this->dados['imageNew'] = ($_FILES['imageNew'] ? $_FILES['imageNew'] : null);
            $editArticle = new \Module\site\Models\StsEditArticle();
            $editArticle->alterArticle($this->dados);
            if ($editArticle->getResult()) {
                $urlRedirect = URLADM . 'view-info-article/detail-info-article/'
                        . $this->dados['id'];
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoArticle = new \Module\site\Models\StsEditArticle();
        $this->dados['form'] = $infoArticle->viewInfoArticle($this->dadoId);
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $listSelect = new \Module\site\Models\StsEditArticle();
            $this->dados['select'] = $listSelect->listArticles();
        
            $button = [
                'viewArticle' => [
                    'menu_controller' => 'view-info-article',
                    'menu_metodo' => 'detail-info-article'],
                'editAuthorArticle' => [
                    'menu_controller' => 'edit-author-article',
                    'menu_metodo' => 'edit-info-author-article']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsArticle'] = $listButton->validateButton($button);

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView(
                    "site/Views/article/editArticle",
                    $this->dados
            );
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Artigo "
                . "não encontrado.</div>";
        $urlRedirect = URLADM . 'list-article/list-info-article';
        return header("Location: $urlRedirect");
    }
}
