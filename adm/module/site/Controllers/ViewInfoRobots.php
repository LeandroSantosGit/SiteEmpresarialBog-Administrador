<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ViewInfoRobots
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ViewInfoRobots
{
    private $dados;
    private $dadoId;
    
    public function detailInfoRobots($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $viewRobot = new \Module\site\Models\StsViewInfoRobots();
            $this->dados['infoRobot'] = $viewRobot->viewInfoRobots($this->dadoId);
            
            $button = [
                'listRobots' => [
                    'menu_controller' => 'list-robots',
                    'menu_metodo' => 'list-info-robots'],
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
            $loadView = new \Config\ConfigView(
                    "site/Views/robots/viewInfoRobots",
                    $this->dados
            );
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Robot da página"
                . " não encontrado.</div>";
        $urlRedirect = URLADM . 'list-robots/list-info-robots';
        return header("Location: $urlRedirect");
    }
}
