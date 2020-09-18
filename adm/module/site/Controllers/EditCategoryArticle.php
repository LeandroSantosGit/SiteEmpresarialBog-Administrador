<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditCategoryArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditCategoryArticle
{
    private $dados;
    private $dadoId;
    
    public function editInfoCategoryArticle($dadoId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            return $this->editCategoryArticle();
        }
    }
    
    private function editCategoryArticle()
    {
        if (!empty($this->dados['editCatArticle'])) {
            unset($this->dados['editCatArticle']);
            $editCatArticle = new \Module\site\Models\StsEditCategoryArticle();
            $editCatArticle->alterCategoryArticle($this->dados);
            if ($editCatArticle->getResult()) {
                $urlRedirect = URLADM 
                        . 'view-info-category-article/detail-info-category-article/'
                        . $this->dados['id'];
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoCatArticle = new \Module\site\Models\StsEditCategoryArticle();
        $this->dados['form'] = $infoCatArticle->viewInfoCategoryArticle($this->dadoId);
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $listSelect = new \Module\site\Models\StsEditCategoryArticle();
            $this->dados['select'] = $listSelect->listCategoryArticle();
        
            $button = [
                'viewCatArticle' => [
                    'menu_controller' => 'view-info-category-article',
                    'menu_metodo' => 'detail-info-category-article']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsCatArticle'] = $listButton->validateButton($button);

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView(
                    "site/Views/categoryArticle/editCategoryArticle",
                    $this->dados
            );
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Categoria de "
                . "artigo não encontrado.</div>";
        $urlRedirect = URLADM . 'list-category-article/list-info-category-article';
        return header("Location: $urlRedirect");
    }
}
