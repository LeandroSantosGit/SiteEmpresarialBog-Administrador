<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ViewInfoTypePage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ViewInfoTypePage
{
    private $dados;
    private $dadoId;
    
    public function detailInfoTypePage($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $typePage = new \Module\administrative\Models\AdmsViewInfoTypePage();
            $this->dados['infoTypPage'] = $typePage->viewTypePage($this->dadoId);
            
            $button = [
                'listTypPage' => [
                    'menu_controller' => 'list-type-page',
                    'menu_metodo' => 'list-types-pages'],
                'editTypPage' => [
                    'menu_controller' => 'edit-type-page',
                    'menu_metodo' => 'edit-info-type-page'],
                'deleteTypPage' => [
                    'menu_controller' => 'delete-type-page',
                    'menu_metodo' => 'remove-type-page']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsTypPage'] = $listButton->validateButton($button);
            
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();

            $loadView = new \Config\ConfigView("administrative/Views/typePage/viewInfoTypePage", $this->dados);
            $loadView->renderView();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Tipo de "
                    . "páginas não encontrado.</div>";
            $urlRedirect = URLADM . 'list-type-page/list-types-pages';
            header("Location: $urlRedirect");
        }
    }
}
