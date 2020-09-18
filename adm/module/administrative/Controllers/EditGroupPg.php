<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditGroupPg
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditGroupPg
{
    private $dados;
    private $dadoId;
    
    public function editInfoGroupPg($dadoId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            return $this->editGroupPgPrivate();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Grupo de páginas não encontrada.</div>";
        $urlRedirect = URLADM . 'list-group-page/list-groups-pages';
        return header("Location: $urlRedirect");
    }
    
    private function editGroupPgPrivate()
    {
        if (!empty($this->dados['editGroupPg'])) {
            unset($this->dados['editGroupPg']);
            $editGroupPg = new \Module\administrative\Models\AdmsEditGroupPg();
            $editGroupPg->alterGroupPage($this->dados);
            if ($editGroupPg->getResult()) {
                $urlRedirect = URLADM . 'view-info-group-pg/detail-info-group-pg/' . $this->dados['id'];
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoGroupPg = new \Module\administrative\Models\AdmsEditGroupPg();
        $this->dados['form'] = $infoGroupPg->viewInfoGroupPage($this->dadoId);
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $button = [
                'viewGrupPg' => [
                    'menu_controller' => 'view-info-group-pg',
                    'menu_metodo' => 'detail-info-group-pg']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsGrupPg'] = $listButton->validateButton($button);

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView("administrative/Views/groupPage/editGroupPg", $this->dados);
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Grupo de páginas não 
                encontrado.</div>";
        $urlRedirect = URLADM . 'list-group-page/list-groups-pages';
        return header("Location: $urlRedirect");
    }
}
