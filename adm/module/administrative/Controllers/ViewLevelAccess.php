<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit(); 
}

/**
 * Description of ViewLevelAccess
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ViewLevelAccess
{
    private $dados;
    private $dadoId;
    
    public function detailAccess($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $viewAcess = new \Module\administrative\Models\AdmsViewLevelAccess();
            $this->dados['dadosNivAc'] = $viewAcess->detailInfoAcess($this->dadoId);
            
            $button = [
                'listAcess' => [
                    'menu_controller' => 'access-level',
                    'menu_metodo' => 'list-access'],
                'editAcess' => [
                    'menu_controller' => 'edit-level-access',
                    'menu_metodo' => 'edit-access'],
                'deleteAcess' => [
                    'menu_controller' => 'delete-level-access',
                    'menu_metodo' => 'remove-acess']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonAcesso'] = $listButton->validateButton($button);
            
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            
            $loadView = new \Config\ConfigView("administrative/Views/levelAccess/viewLevelAccess", $this->dados);
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-success'>Usuário cadastro com sucesso</div>";
        $urlRedirect = URLADM . 'access-level/list-access';
        return header("Location: $urlRedirect");
        
    }
}
