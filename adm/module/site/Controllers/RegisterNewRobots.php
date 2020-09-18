<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of RegisterNewRobots
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class RegisterNewRobots
{
    private $dados;
    
    public function registerInfoRobots()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['registerNewRobots'])) {
            unset($this->dados['registerNewRobots']);
            $addRobots = new \Module\site\Models\StsRegisterNewRobots();
            $addRobots->viewRobots($this->dados);
            if ($addRobots->getResult()) {
                $urlRedirect = URLADM . 'list-robots/list-info-robots';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        return $this->renderView();
    }
    
    private function renderView()
    {
        $button = [
            'listRobots' => [
                'menu_controller' => 'list-robots',
                'menu_metodo' => 'list-info-robots']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsRobots'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $loadView = new \Config\ConfigView("site/Views/robots/registerNewRobots", $this->dados);
        return $loadView->renderView();
    }
}
