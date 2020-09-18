<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ListSituationUser
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ListSituationUser
{
    private $dados;
    private $pageId;
    
    public function listSituationUsers($pageId = null)
    {
        $this->pageId = (int) $pageId ? $pageId : 1;
        
        $button = [
            'cadSitUser' => [
                'menu_controller' => 'register-new-situation-user',
                'menu_metodo' => 'register-info-situation-user'],
            'viewSitUser' => [
                'menu_controller' => 'view-info-situation-user',
                'menu_metodo' => 'detail-info-situation-user'],
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
        
        $listSitUser = new \Module\administrative\Models\AdmsListSituationUser();
        $this->dados['listSitUser'] = $listSitUser->listSituationUsers($pageId);
        $this->dados['pagination'] = $listSitUser->getResultPg();
        
        $loadView = new \Config\ConfigView("administrative/Views/situationUser/listSituationUser", $this->dados);
        $loadView->renderView();
    }
}
