<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditTypeArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditTypeArticle
{
    private $dados;
    private $dadoId;
            
    public function editInfoTypeArticle($dadoId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            return $this->editTypeArticle();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Tipo de "
                    . "artigo não encontrado.</div>";
        $urlRedirect = URLADM . 'list-type-article/list-info-type-article';
        return header("Location: $urlRedirect");
    }
    
    private function editTypeArticle()
    {
        if (!empty($this->dados['editTypeArticle'])) {
            unset($this->dados['editTypeArticle']);
            $editTpArticle = new \Module\site\Models\StsEditTypeArticle();
            $editTpArticle->alterTypeArticle($this->dados);
            if ($editTpArticle->getResult()) {
                $urlRedirect = URLADM . 'view-info-type-article/detail-info-type-article/'
                        . $this->dados['id'];
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoTpArticle = new \Module\site\Models\StsEditTypeArticle();
        $this->dados['form'] = $infoTpArticle->viewInfoTypeArticle($this->dadoId);
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $button = [
                'viewTypeArticle' => [
                    'menu_controller' => 'view-info-type-article',
                    'menu_metodo' => 'detail-info-type-article']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsTypeArticle'] = $listButton->validateButton($button);

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView("site/Views/typeArticle/editTypeArticle", $this->dados);
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Tipo de artigo"
                . " não encontrado.</div>";
        $urlRedirect = URLADM . 'list-type-article/list-info-type-article';
        return header("Location: $urlRedirect");
    }
}
