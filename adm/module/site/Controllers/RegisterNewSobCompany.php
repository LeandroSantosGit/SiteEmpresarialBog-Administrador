<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of RegisterNewSobCompany
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class RegisterNewSobCompany
{
    private $dados;
    
    public function registerInfoSobCompany()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['registerSobCompany'])) {
            unset($this->dados['registerSobCompany']);
            $this->dados['imageNew'] = ($_FILES['imageNew'] ? $_FILES['imageNew'] : null);
            $addSobCompany = new \Module\site\Models\StsRegisterNewSobCompany();
            $addSobCompany->registerNewSobCompany($this->dados);
            if ($addSobCompany->getResult()) {
                $urlRedirect = URLADM . 'list-sob-company/list-info-company';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        return $this->renderView();
    }
    
    private function renderView()
    {
        $listSelect = new \Module\site\Models\StsRegisterNewSobCompany();
        $this->dados['select'] = $listSelect->listSobCompany();
        
        $button = [
            'listSobCompany' => [
                'menu_controller' => 'list-sob-company',
                'menu_metodo' => 'list-info-company']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsSobCompany'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $loadView = new \Config\ConfigView("site/Views/sobCompany/registerNewSobCompany", $this->dados);
        return $loadView->renderView();
    }
}
