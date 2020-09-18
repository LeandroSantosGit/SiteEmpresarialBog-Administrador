<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ListRobots
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ListRobots
{
    private $dados;
    private $pageId;
    
    public function listInfoRobots($pageId = null)
    {
        $this->pageId = (int) $pageId ? $pageId : 1;
        $button = [
            'cadRobots' => [
                'menu_controller' => 'register-new-robots',
                'menu_metodo' => 'register-info-robots'],
            'viewRobots' => [
                'menu_controller' => 'view-info-robots',
                'menu_metodo' => 'detail-info-robots'],
            'editRobots' => [
                'menu_controller' => 'edit-robots',
                'menu_metodo' => 'edit-info-robots'],
            'deleteRobots' => [
                'menu_controller' => 'delete-robots',
                'menu_metodo' => 'remove-robots']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsRobots'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $listRobots = new \Module\site\Models\StsListRobots();
        $this->dados['listRobots'] = $listRobots->listInfoRobots($pageId);
        $this->dados['pagination'] = $listRobots->getResultPg();
        
        $loadView = new \Config\ConfigView("site/Views/robots/listRobots", $this->dados);
        $loadView->renderView();
    }
}
