<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditSituation
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditSituation
{
    private $dados;
    private $dadoId;
    
    public function editInfoSituation($dadoId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            return $this->editSituationPrivate();
        }$_SESSION['msg'] = "<div class='alert alert-danger'>Situação não encontrada.</div>";
        $urlRedirect = URLADM . 'list-situation/list-situations';
        return header("Location: $urlRedirect");
    }
    
    private function editSituationPrivate()
    {
        if (!empty($this->dados['editSituation'])) {
            unset($this->dados['editSituation']);
            $editSituation = new \Module\administrative\Models\AdmsEditSituation();
            $editSituation->alterSituation($this->dados);
            if ($editSituation->getResult()) {
                $urlRedirect = URLADM . 'view-info-situation/detail-info-situation/' . $this->dados['id'];
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoSituation = new \Module\administrative\Models\AdmsEditSituation();
        $this->dados['form'] = $infoSituation->viewInfoSituation($this->dadoId);
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $listSelect = new \Module\administrative\Models\AdmsEditSituation();
            $this->dados['select'] = $listSelect->listSituation();
        
            $button = 
            ['viewSit' => [
                'menu_controller' => 'view-info-situation',
                'menu_metodo' => 'detail-info-situation']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsSituation'] = $listButton->validateButton($button);

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView("administrative/Views/situation/editSituation", $this->dados);
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Situação não 
                encontrada.</div>";
        $urlRedirect = URLADM . 'list-situation/list-situations';
        return header("Location: $urlRedirect");
    }
}
