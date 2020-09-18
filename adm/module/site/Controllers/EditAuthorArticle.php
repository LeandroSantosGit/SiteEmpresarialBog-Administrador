<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditAuthorArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditAuthorArticle
{
    private $dados;
    private $dadoId;
    
    public function editInfoAuthorArticle($dadoId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            return $this->editAuthorArticle();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Autor do "
                    . "artigo não encontrado.</div>";
        $urlRedirect = URLADM . 'list-article/list-info-article';
        return header("Location: $urlRedirect");
    }
    
    private function editAuthorArticle()
    {
        if (!empty($this->dados['editAuthorArticle'])) {
            unset($this->dados['editAuthorArticle']);
            $editAuthor = new \Module\site\Models\StsEditAuthorArticle();
            $editAuthor->alterAuthorArticle($this->dados);
            if ($editAuthor->getResult()) {
                $urlRedirect = URLADM . 'view-info-article/detail-info-article/'
                        . $this->dados['id'];
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoAuthor = new \Module\site\Models\StsEditAuthorArticle();
        $this->dados['form'] = $infoAuthor->viewInfoAuthorArticle($this->dadoId);
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $listSelect = new \Module\site\Models\StsEditAuthorArticle();
            $this->dados['select'] = $listSelect->listAuthorArticle();
        
            $button = [
                'viewArticle' => [
                    'menu_controller' => 'view-info-article',
                    'menu_metodo' => 'detail-info-article']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsArticle'] = $listButton->validateButton($button);

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView(
                    "site/Views/article/editAuthorArticle",
                    $this->dados
            );
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Autor do "
                . "artigo não encontrado.</div>";
        $urlRedirect = URLADM . 'list-article/list-info-article';
        return header("Location: $urlRedirect");
    }
}
