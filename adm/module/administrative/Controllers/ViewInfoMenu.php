<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ViewInfoMenu
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ViewInfoMenu
{
    private $dados;
    private $dadoId;
    
    public function detailInfoMenu($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $viewMenu = new \Module\administrative\Models\AdmsViewInfoMenu();
            $this->dados['infoMenu'] = $viewMenu->viewMenu($this->dadoId);
            
            $button = [
                'listMenu' => [
                    'menu_controller' => 'list-menu',
                    'menu_metodo' => 'list-itens-menu'],
                'editMenu' => [
                    'menu_controller' => 'edit-menu',
                    'menu_metodo' => 'edit-info-menu'],
                'deleteMenu' => [
                    'menu_controller' => 'delete-menu',
                    'menu_metodo' => 'remove-menu']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsMenu'] = $listButton->validateButton($button);
            
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();

            $loadView = new \Config\ConfigView("administrative/Views/menu/viewInfoMenu", $this->dados);
            $loadView->renderView();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro, 
                    item do menu não encontrado.</div>";
            $urlRedirect = URLADM . 'list-menu/list-itens-menu';
            header("Location: $urlRedirect");
        }
    }
}
