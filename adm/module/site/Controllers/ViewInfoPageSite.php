<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ViewInfoPageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ViewInfoPageSite
{
    private $dados;
    private $dadoId;
    
    public function detailInfoPageSite($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $viewPage = new \Module\site\Models\StsViewInfoPageSite();
            $this->dados['infoPage'] = $viewPage->viewInfoPageSite($this->dadoId);
            $button = [
                'listPage' => [
                    'menu_controller' => 'list-page-site',
                    'menu_metodo' => 'list-info-page-site'],
                'editPage' => [
                    'menu_controller' => 'edit-page-site',
                    'menu_metodo' => 'edit-info-page-site'],
                'deletePage' => [
                    'menu_controller' => 'delete-page-site',
                    'menu_metodo' => 'remove-page-site']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsPage'] = $listButton->validateButton($button);
            
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();

            $loadView = new \Config\ConfigView(
                    "site/Views/page/viewInfoPageSite",
                    $this->dados
            );
            $loadView->renderView();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Página"
                    . " não encontrado.</div>";
            $urlRedirect = URLADM . 'list-page-site/list-info-page-site';
            header("Location: $urlRedirect");
        }
    }
}
