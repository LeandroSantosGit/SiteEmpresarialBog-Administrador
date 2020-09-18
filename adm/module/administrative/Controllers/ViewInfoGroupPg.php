<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ViewInfoGroupPg
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ViewInfoGroupPg
{
    private $dados;
    private $dadoId;
    
    public function detailInfoGroupPg($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $viewGoupPg = new \Module\administrative\Models\AdmsViewInfoGroupPg();
            $this->dados['infoGroupPg'] = $viewGoupPg->viewGroupPage($this->dadoId);
            
            $button = [
                'listGrupPg' => [
                    'menu_controller' => 'list-group-page',
                    'menu_metodo' => 'list-groups-pages'],
                'editGrupPg' => [
                    'menu_controller' => 'edit-group-pg',
                    'menu_metodo' => 'edit-info-group-pg'],
                'deleteGrupPg' => [
                    'menu_controller' => 'delete-group-pg',
                    'menu_metodo' => 'remove-group-pg']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsGrupPg'] = $listButton->validateButton($button);
            
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();

            $loadView = new \Config\ConfigView("administrative/Views/groupPage/viewInfoGroupPg", $this->dados);
            $loadView->renderView();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro, página não encontrada.</div>";
            $urlRedirect = URLADM . 'list-group-page/list-groups-pages';
            header("Location: $urlRedirect");
        }
    }
}
