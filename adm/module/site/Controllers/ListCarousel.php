<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ListCarousel
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ListCarousel
{
    private $dados;
    private $pageId;
    
    public function listCarousels($pageId = null)
    {
        $this->pageId = (int) $pageId ? $pageId : 1;
        $button = [
            'cadCarousel' => [
                'menu_controller' => 'register-new-carousel',
                'menu_metodo' => 'register-info-carousel'],
            'viewCarousel' => [
                'menu_controller' => 'view-info-carousel',
                'menu_metodo' => 'detail-info-carousel'],
            'editCarousel' => [
                'menu_controller' => 'edit-carousel',
                'menu_metodo' => 'edit-info-carousel'],
            'deleteCarousel' => [
                'menu_controller' => 'delete-carousel',
                'menu_metodo' => 'remove-carousel'],
            'alterOrderCarousel' => [
                    'menu_controller' => 'modify-order-carousel',
                    'menu_metodo' => 'alter-order-carousel'],
            'alterSitCarousel' => [
                'menu_controller' => 'modify-situation-carousel',
                'menu_metodo' => 'alter-situation-carousel']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsCarousel'] = $listButton->validateButton($button);

        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $listCarousel = new \Module\site\Models\StsListCarousel();
        $this->dados['listCarousel'] = $listCarousel->listCarousel($this->pageId);
        $this->dados['pagination'] = $listCarousel->getResultPg();
        
        $loadView = new \Config\ConfigView("site/Views/carousel/listCarousel", $this->dados);
        $loadView->renderView();
    }
}
