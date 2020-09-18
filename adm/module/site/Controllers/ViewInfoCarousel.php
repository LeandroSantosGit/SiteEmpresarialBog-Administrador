<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location");
    exit();
}

/**
 * Description of ViewInfoCarousel
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ViewInfoCarousel
{
    private $dados;
    private $dadoId;
    
    public function detailInfoCarousel($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $viewCarousel = new \Module\site\Models\StsViewInfoCarousel();
            $this->dados['infoCarousel'] = $viewCarousel->viewInfoCarousel($this->dadoId);
            
            $button = [
                'listCarousel' => [
                    'menu_controller' => 'list-carousel',
                    'menu_metodo' => 'list-carousels'],
                'editCarousel' => [
                    'menu_controller' => 'edit-carousel',
                    'menu_metodo' => 'edit-info-carousel'],
                'deleteCarousel' => [
                    'menu_controller' => 'delete-carousel',
                    'menu_metodo' => 'remove-carousel']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsCarousel'] = $listButton->validateButton($button);
            
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();

            $loadView = new \Config\ConfigView(
                    "site/Views/carousel/viewInfoCarousel",
                    $this->dados
            );
            $loadView->renderView();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Slide carousel"
                    . " não encontrado.</div>";
            $urlRedirect = URLADM . 'list-carousel/list-carousels';
            header("Location: $urlRedirect");
        }
    }
}
