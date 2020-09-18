<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditPageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditPageSite
{
    private $dados;
    private $dadoId;
    
    public function editInfoPageSite($dadoId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            return $this->editPageSite();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Página "
                    . "do site não encontrado.</div>";
        $urlRedirect = URLADM . 'list-page-site/list-info-page-site';
        return header("Location: $urlRedirect");
    }
    
    private function editPageSite()
    {
        if (!empty($this->dados['editPageSite'])) {
            unset($this->dados['editPageSite']);
            $this->dados['imageNew'] = ($_FILES['imageNew'] ? $_FILES['imageNew'] : null);
            $editPage = new \Module\site\Models\StsEditPageSite();
            $editPage->alterPageSite($this->dados);
            if ($editPage->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Página do "
                    . "site editado.</div>";
                $urlRedirect = URLADM . 'view-info-page-site/detail-info-page-site/'
                        . $this->dados['id'];
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoPage = new \Module\site\Models\StsEditPageSite();
        $this->dados['form'] = $infoPage->viewInfoPageSite($this->dadoId);
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $listSelect = new \Module\site\Models\StsEditPageSite();
            $this->dados['select'] = $listSelect->listPageSite();
        
            $button = [
                'viewPage' => [
                    'menu_controller' => 'view-info-page-site',
                    'menu_metodo' => 'detail-info-page-site']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsPage'] = $listButton->validateButton($button);

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView("site/Views/page/editPageSite", $this->dados);
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Página do site não 
                encontrado.</div>";
        $urlRedirect = URLADM . 'list-page-site/list-info-page-site';
        return header("Location: $urlRedirect");
    }
}
