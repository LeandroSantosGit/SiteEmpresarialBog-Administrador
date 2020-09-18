<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ViewInfoTypepgSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ViewInfoTypepgSite
{
    private $dados;
    private $dadoId;
    
    public function detailInfoTypepgSite($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $viewTypePg = new \Module\site\Models\StsViewInfoTypepgSite();
            $this->dados['infoTypePage'] = $viewTypePg->viewInfoTypePageSite($this->dadoId);
            $button = [
                'listTypePg' => [
                    'menu_controller' => 'list-typepg-site',
                    'menu_metodo' => 'list-info-typepg-site'],
                'editTypePg' => [
                    'menu_controller' => 'edit-typepg-site',
                    'menu_metodo' => 'edit-info-typepg-site'],
                'deleteTypePg' => [
                    'menu_controller' => 'delete-typepg-site',
                    'menu_metodo' => 'remove-typepg-site']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsTypePg'] = $listButton->validateButton($button);
            
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();

            $loadView = new \Config\ConfigView(
                    "site/Views/typePageSite/viewInfoTypepgSite",
                    $this->dados
            );
            $loadView->renderView();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Tipo"
                    . " de página não encontrado.</div>";
            $urlRedirect = URLADM . 'list-typepg-site/list-info-typepg-site';
            header("Location: $urlRedirect");
        }
    }
}
