<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditSobCompany
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditSobCompany
{
    private $dados;
    private $dadoId;
    
    public function editInfoSobCompany($dadoId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            return $this->editSobCompany();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Sobre "
                    . "empresa não encontrado.</div>";
        $urlRedirect = URLADM . 'list-sob-company/list-info-company';
        return header("Location: $urlRedirect");
    }
    
    private function editSobCompany()
    {
        if (!empty($this->dados['editSobCompany'])) {
            unset($this->dados['editSobCompany']);
            $this->dados['imageNew'] = ($_FILES['imageNew'] ? $_FILES['imageNew'] : null);
            $editSobCompany = new \Module\site\Models\StsEditSobCompany();
            $editSobCompany->alterSobCompany($this->dados);
            if ($editSobCompany->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Sobre "
                    . "empresa editado.</div>";
                $urlRedirect = URLADM . 'view-info-sob-company/detail-info-sob-company/'
                        . $this->dados['id'];
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoSobCompany = new \Module\site\Models\StsEditSobCompany();
        $this->dados['form'] = $infoSobCompany->viewSobCompany($this->dadoId);
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $listSelect = new \Module\site\Models\StsEditSobCompany();
            $this->dados['select'] = $listSelect->listSobCompany();
        
            $button = [
                'viewSobCompany' => [
                    'menu_controller' => 'view-info-sob-company',
                    'menu_metodo' => 'detail-info-sob-company']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsSobCompany'] = $listButton->validateButton($button);

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView(
                    "site/Views/sobCompany/editSobCompany",
                    $this->dados
            );
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Sobre empresa"
                . " não encontrado.</div>";
        $urlRedirect = URLADM . 'list-sob-company/list-info-company';
        return header("Location: $urlRedirect");
    }
}
