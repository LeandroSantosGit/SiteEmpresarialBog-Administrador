<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditRobots
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditRobots
{
    private $dados;
    private $dadoId;
    
    public function editInfoRobots($dadoId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            return $this->editRobots();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Robots não encontrado.</div>";
        $urlRedirect = URLADM . 'list-robots/list-info-robots';
        return header("Location: $urlRedirect");
    }
    
    private function editRobots()
    {
        if (!empty($this->dados['editInfoRobots'])) {
            unset($this->dados['editInfoRobots']);
            $editRobost = new \Module\site\Models\StsEditRobots();
            $editRobost->alterRobots($this->dados);
            if ($editRobost->getResult()) {
                $urlRedirect = URLADM . 'view-info-robots/detail-info-robots/'
                        . $this->dados['id'];
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoRobots = new \Module\site\Models\StsEditRobots();
        $this->dados['form'] = $infoRobots->viewRobots($this->dadoId);
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $button = [
                'viewRobots' => [
                    'menu_controller' => 'view-info-robots',
                    'menu_metodo' => 'detail-info-robots']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsRobots'] = $listButton->validateButton($button);

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView("site/Views/robots/editRobots", $this->dados);
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Robots não encontrado.</div>";
        $urlRedirect = URLADM . 'list-robots/list-info-robots';
        return header("Location: $urlRedirect");
    }
}
