<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditCarousel
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditCarousel
{
    private $dados;
    private $dadoId;
    
    public function editInfoCarousel($dadoId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            return $this->editCarousel();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Slide do "
                    . "carousel não encontrado.</div>";
        $urlRedirect = URLADM . 'list-carousel/list-carousels';
        return header("Location: $urlRedirect");
    }
    
    private function editCarousel()
    {
        if (!empty($this->dados['editCarousel'])) {
            unset($this->dados['editCarousel']);
            $this->dados['imageNew'] = ($_FILES['imageNew'] ? $_FILES['imageNew'] : null);
            $editCarousel = new \Module\site\Models\StsEditCarousel();
            $editCarousel->alterCarrourel($this->dados);
            if ($editCarousel->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Slide do "
                    . "carousel editado.</div>";
                $urlRedirect = URLADM . 'view-info-carousel/detail-info-carousel/'
                        . $this->dados['id'];
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoCarousel = new \Module\site\Models\StsEditCarousel();
        $this->dados['form'] = $infoCarousel->viewInfoCarousel($this->dadoId);
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $listSelect = new \Module\site\Models\StsEditCarousel();
            $this->dados['select'] = $listSelect->listCarousel();
        
            $button = [
                'viewCarousel' => [
                    'menu_controller' => 'view-info-carousel',
                    'menu_metodo' => 'detail-info-carousel']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsCarousel'] = $listButton->validateButton($button);

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView("site/Views/carousel/editCarousel", $this->dados);
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Slide carousel não 
                encontrado.</div>";
        $urlRedirect = URLADM . 'list-carousel/list-carousels';
        return header("Location: $urlRedirect");
    }
}
