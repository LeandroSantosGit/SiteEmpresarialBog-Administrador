<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ViewInfoPage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ViewInfoPage
{
    private $dados;
    private $dadoId;
    
    public function detailInfoPage($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $infoPage = new \Module\administrative\Models\AdmsViewInfoPage();
            $this->dados['infoPage'] = $infoPage->viewPage($this->dadoId);
            
            $button = [
                'listPage' => [
                    'menu_controller' => 'list-page',
                    'menu_metodo' => 'list-pages'],
                'editPage' => [
                    'menu_controller' => 'edit-page',
                    'menu_metodo' => 'edit-info-page'],
                'deletePage' => [
                    'menu_controller' => 'delete-page',
                    'menu_metodo' => 'remove-page']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonAcesso'] = $listButton->validateButton($button);
            
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();

            $loadView = new \Config\ConfigView("administrative/Views/page/viewInfoPage", $this->dados);
            $loadView->renderView();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro, página não encontrado.</div>";
            $urlRedirect = URLADM . 'list-page/list-pages';
            header("Location: $urlRedirect");
        }
    }
}
