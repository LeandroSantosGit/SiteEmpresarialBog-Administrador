<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ViewInfoSitpageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ViewInfoSitpageSite
{
    private $dados;
    private $dadoId;
    
    public function detailInfoSitpageSite($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $situationPage = new \Module\site\Models\StsViewInfoSitpageSite();
            $this->dados['infoSitPageSite'] = $situationPage->viewInfoSituationPageSite($this->dadoId);
            
            $button = [
                'listSitPage' => [
                    'menu_controller' => 'list-sitpage-site',
                    'menu_metodo' => 'list-info-sitpage-site'],
                'editSitPage' => [
                    'menu_controller' => 'edit-sitpage-site',
                    'menu_metodo' => 'edit-info-sitpage-site'],
                'deleteSitPage' => [
                    'menu_controller' => 'delete-sitpage-site',
                    'menu_metodo' => 'remove-sitpage-site']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsSitPage'] = $listButton->validateButton($button);
            
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();

            $loadView = new \Config\ConfigView(
                    "site/Views/situationPageSite/viewInfoSitpageSite",
                    $this->dados
            );
            $loadView->renderView();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Situação de "
                    . " página do site não encontrado.</div>";
            $urlRedirect = URLADM . 'list-sitpage-site/list-info-sitpage-site';
            header("Location: $urlRedirect");
        }
    }
}
