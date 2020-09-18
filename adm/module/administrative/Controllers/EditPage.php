<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditPage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditPage
{
    private $dados;
    private $dadoId;
    
    public function editInfoPage($dadoId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            return $this->editPagePrivate();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Página não encontrado.</div>";
        $urlRedirect = URLADM . 'list-page/list-pages';
        return header("Location: $urlRedirect");
    }
    
    private function editPagePrivate()
    {
        if (!empty($this->dados['editInfoPage'])) {
            unset($this->dados['editInfoPage']);
            $editPage = new \Module\administrative\Models\AdmsEditPage();
            $editPage->AdmsEditPage($this->dados);
            if ($editPage->getResult()) {
               $_SESSION['msg'] = "<div class='alert alert-success'>Página alterada com sucesso.</div>";
                $urlRedirect = URLADM . 'view-info-page/detail-info-page/' . $this->dados['id'];
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoPage = new \Module\administrative\Models\AdmsEditPage();
        $this->dados['form'] = $infoPage->viewInfoPage($this->dadoId);
        return $this->renderView();
    }


    private function renderView()
    {
        if ($this->dados['form']) {
            $listSelect = new \Module\administrative\Models\AdmsEditPage();
            $this->dados['select'] = $listSelect->listRegisterPage();
            
            $button = 
            ['viewPage' => [
                'menu_controller' => 'view-info-page',
                'menu_metodo' => 'detail-info-page']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonAcesso'] = $listButton->validateButton($button);

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView("administrative/Views/page/editPage", $this->dados);
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Página não encontrado.</div>";
        $urlRedirect = URLADM . 'list-page/list-pages';
        return header("Location: $urlRedirect");
    }
}
