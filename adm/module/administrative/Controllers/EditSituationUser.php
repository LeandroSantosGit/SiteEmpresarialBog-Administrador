<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditSituationUser
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditSituationUser
{
    private $dados;
    private $dadoId;
    
    public function editInfoSituationUser($dadoId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            return $this->editSituationUserPrivate();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Situação usuário"
                . " não encontrada.</div>";
        $urlRedirect = URLADM . 'list-situation-user/list-situation-users';
        return header("Location: $urlRedirect");
    }
    
    private function editSituationUserPrivate()
    {
        if (!empty($this->dados['editSitUser'])) {
            unset($this->dados['editSitUser']);
            $editSitUser = new \Module\administrative\Models\AdmsEditSituationUser();
            $editSitUser->alterSituationUser($this->dados);
            if ($editSitUser->getResult()) {
                $urlRedirect = URLADM . 'view-info-situation-user/detail-info-situation-user/'
                        . $this->dados['id'];
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoSitUser = new \Module\administrative\Models\AdmsEditSituationUser();
        $this->dados['form'] = $infoSitUser->viewInfoSituationUser($this->dadoId);
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $listSelect = new \Module\administrative\Models\AdmsEditSituationUser();
            $this->dados['select'] = $listSelect->listSituationUser();
        
            $button = [
                'viewSitUser' => [
                    'menu_controller' => 'view-info-situation-user',
                    'menu_metodo' => 'detail-info-situation-user']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonSitUser'] = $listButton->validateButton($button);

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView("administrative/Views/situationUser/editSituationUser", $this->dados);
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Situação usuário não 
                encontrada.</div>";
        $urlRedirect = URLADM . 'list-situation-user/list-situation-users';
        return header("Location: $urlRedirect");
    }
}
