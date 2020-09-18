<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of RegisterNewCarousel
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class RegisterNewCarousel
{
    private $dados;
    
    public function registerInfoCarousel()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['registerCarousel'])) {
            unset($this->dados['registerCarousel']);
            $this->dados['imageNew'] = ($_FILES['imageNew'] ? $_FILES['imageNew'] : null);
            $addCarousel = new \Module\site\Models\StsRegisterNewCarousel();
            $addCarousel->registerNewCarousel($this->dados);
            if ($addCarousel->getResult()) {
                $urlRedirect = URLADM . 'list-carousel/list-carousels';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        return $this->renderView();
    }
    
    private function renderView()
    {
        $listSelect = new \Module\site\Models\StsRegisterNewCarousel();
        $this->dados['select'] = $listSelect->listCarousel();
        
        $button = [
            'listCarousel' => [
                'menu_controller' => 'list-carousel',
                'menu_metodo' => 'list-carousels']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsCarousel'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $loadView = new \Config\ConfigView("site/Views/carousel/registerNewCarousel", $this->dados);
        return $loadView->renderView();
    }
}
