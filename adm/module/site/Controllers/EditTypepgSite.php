<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditTypepgSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditTypepgSite
{
    private $dados;
    private $dadoId;
    
    public function editInfoTypepgSite($dadoId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            return $this->editTypePage();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Tipo de "
                    . "página não encontrado.</div>";
        $urlRedirect = URLADM . 'list-typepg-site/list-info-typepg-site';
        return header("Location: $urlRedirect");
    }
    
    private function editTypePage()
    {
        if (!empty($this->dados['editTypepgSite'])) {
            unset($this->dados['editTypepgSite']);
            $editTypePage = new \Module\site\Models\StsEditTypepgSite();
            $editTypePage->alterTypePageSite($this->dados);
            if ($editTypePage->getResult()) {
                $urlRedirect = URLADM . 'view-info-typepg-site/detail-info-typepg-site/'
                        . $this->dados['id'];
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoTypepgSite = new \Module\site\Models\StsEditTypepgSite();
        $this->dados['form'] = $infoTypepgSite->viewTypePageSite($this->dadoId);
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $button = [
                'viewTypePg' => [
                    'menu_controller' => 'view-info-typepg-site',
                    'menu_metodo' => 'detail-info-typepg-site']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsTypePg'] = $listButton->validateButton($button);

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView(
                    "site/Views/typePageSite/editTypepgSite",
                    $this->dados
            );
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Tipo de página"
                . " não encontrado.</div>";
        $urlRedirect = URLADM . 'list-typepg-site/list-info-typepg-site';
        return header("Location: $urlRedirect");
    }
}
