<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ViewInfoSituation
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ViewInfoSituation
{
    private $dados;
    private $dadoId;
    
    public function detailInfoSituation($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $color = new \Module\administrative\Models\AdmsViewInfoSituation();
            $this->dados['infoSituation'] = $color->viewSituation($this->dadoId);
            
            $button = [
                'listSit' => [
                    'menu_controller' => 'list-situation',
                    'menu_metodo' => 'list-situations'],
                'editSit' => [
                    'menu_controller' => 'edit-situation',
                    'menu_metodo' => 'edit-info-situation'],
                'deleteSit' => [
                    'menu_controller' => 'delete-situation',
                    'menu_metodo' => 'remove-situation']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsSituation'] = $listButton->validateButton($button);
            
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();

            $loadView = new \Config\ConfigView("administrative/Views/situation/viewInfoSituation", $this->dados);
            $loadView->renderView();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro, situação não encontrado.</div>";
            $urlRedirect = URLADM . 'list-situation/list-situations';
            header("Location: $urlRedirect");
        }
    }
}
