<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of viewInfoSobCompany
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class viewInfoSobCompany
{
    private $dados;
    private $dadoId;
    
    public function detailInfoSobCompany($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $viewSobCompany = new \Module\site\Models\StsviewInfoSobCompany();
            $this->dados['infoSobCompany'] = $viewSobCompany->viewInfoSobCompany($this->dadoId);
            
            $button = [
                'listSobCompany' => [
                    'menu_controller' => 'list-sob-company',
                    'menu_metodo' => 'list-info-company'],
                'editSobCompany' => [
                    'menu_controller' => 'edit-sob-company',
                    'menu_metodo' => 'edit-info-sob-company'],
                'deleteSobCompany' => [
                    'menu_controller' => 'delete-sob-company',
                    'menu_metodo' => 'remove-sob-company']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsSobCompany'] = $listButton->validateButton($button);
            
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();

            $loadView = new \Config\ConfigView(
                    "site/Views/sobCompany/viewInfoSobCompany",
                    $this->dados
            );
            $loadView->renderView();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Sobre empresa"
                    . " não encontrado.</div>";
            $urlRedirect = URLADM . 'list-sob-company/list-info-company';
            header("Location: $urlRedirect");
        }
    }
}
