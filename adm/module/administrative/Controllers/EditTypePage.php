<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditTypePage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditTypePage
{
    private $dados;
    private $dadoId;
    
    public function editInfoTypePage($dadoId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            return $this->editTypePagePrivate();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Tipo de página não encontrado.</div>";
        $urlRedirect = URLADM . 'list-type-page/list-types-pages';
        return header("Location: $urlRedirect");
    }
    
    private function editTypePagePrivate()
    {
        if (!empty($this->dados['editTypePage'])) {
            unset($this->dados['editTypePage']);
            $editTypPg = new \Module\administrative\Models\AdmsEditTypePage();
            $editTypPg->alterTypePage($this->dados);
            if ($editTypPg->getResult()) {
                $urlRedirect = URLADM . 'view-info-type-page/detail-info-type-page/' . $this->dados['id'];
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoTypPg = new \Module\administrative\Models\AdmsEditTypePage();
        $this->dados['form'] = $infoTypPg->viewInfoTypePage($this->dadoId);
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $button = 
            ['viewTypPage' => [
                'menu_controller' => 'view-info-type-page',
                'menu_metodo' => 'detail-info-type-page']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsTypPage'] = $listButton->validateButton($button);

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView("administrative/Views/typePage/editTypePage", $this->dados);
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Tipo de página não 
                encontrado.</div>";
        $urlRedirect = URLADM . 'list-type-page/list-types-pages';
        return header("Location: $urlRedirect");
    }
}
