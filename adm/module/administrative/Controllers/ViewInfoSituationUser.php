<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ViewInfoSituationUser
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ViewInfoSituationUser
{
    private $dados;
    private $dadoId;
    
    public function detailInfoSituationUser($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $sitUser = new \Module\administrative\Models\AdmsViewInfoSituationUser();
            $this->dados['infoSitUser'] = $sitUser->viewSituationUser($this->dadoId);
            
            $button = [
                'listSitUser' => [
                    'menu_controller' => 'list-situation-user',
                    'menu_metodo' => 'list-situation-users'],
                'editSitUser' => [
                    'menu_controller' => 'edit-situation-user',
                    'menu_metodo' => 'edit-info-situation-user'],
                'deleteSitUser' => [
                    'menu_controller' => 'delete-situation-user',
                    'menu_metodo' => 'remove-situation-user']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonSitUser'] = $listButton->validateButton($button);
            
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();

            $loadView = new \Config\ConfigView("administrative/Views/situationUser/viewInfoSituationUser", $this->dados);
            $loadView->renderView();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Situação usuário"
                    . " não encontrado.</div>";
            $urlRedirect = URLADM . 'list-situation-user/list-situation-users';
            header("Location: $urlRedirect");
        }
    }
}
