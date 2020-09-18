<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ViewInfoColor
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ViewInfoColor
{
    private $dados;
    private  $dadoId;
    
    public function detailInfoColor($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $color = new \Module\administrative\Models\AdmsViewInfoColor();
            $this->dados['infoColor'] = $color->viewColor($this->dadoId);
            
            $button = [
                'listColor' => [
                    'menu_controller' => 'list-color',
                    'menu_metodo' => 'list-colors'],
                'editColor' => [
                    'menu_controller' => 'edit-color',
                    'menu_metodo' => 'edit-info-color'],
                'deleteColor' => [
                    'menu_controller' => 'delete-color',
                    'menu_metodo' => 'remove-color']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsColor'] = $listButton->validateButton($button);
            
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();

            $loadView = new \Config\ConfigView("administrative/Views/colors/viewInfoColor", $this->dados);
            $loadView->renderView();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Cor não encontrada.</div>";
            $urlRedirect = URLADM . 'list-color/list-colors';
            header("Location: $urlRedirect");
        }
    }
}
