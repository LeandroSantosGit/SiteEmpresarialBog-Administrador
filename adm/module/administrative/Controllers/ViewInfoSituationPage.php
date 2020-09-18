<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ViewInfoSituationPage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ViewInfoSituationPage
{
    private $dadoId;
    
    public function detailInfoSituationPage($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $sitPage = new \Module\administrative\Models\AdmsViewInfoSituationPage();
            $this->dados['infoSitPage'] = $sitPage->viewInfoSituationPage($this->dadoId);
            
            $button = [
                'listSitPage' => [
                    'menu_controller' => 'list-situation-page',
                    'menu_metodo' => 'list-situation-pages'],
                'editSitPage' => [
                    'menu_controller' => 'edit-situation-page',
                    'menu_metodo' => 'edit-info-situation-page'],
                'deleteSitPage' => [
                    'menu_controller' => 'delete-situation-page',
                    'menu_metodo' => 'remove-situation-page']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonSitPage'] = $listButton->validateButton($button);
            
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();

            $loadView = new \Config\ConfigView("administrative/Views/situationPage"
                    . "/viewInfoSituationPage", $this->dados);
            $loadView->renderView();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Situação de "
                    . "página não encontrada.</div>";
            $urlRedirect = URLADM . 'list-situation-page/list-situation-pages';
            header("Location: $urlRedirect");
        }
    }
}
