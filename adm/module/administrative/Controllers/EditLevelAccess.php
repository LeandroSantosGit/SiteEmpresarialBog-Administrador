<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditLevelAccess
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditLevelAccess
{
    private $dados;
    private $dadoId;
    
    public function editAccess($dadoId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            return $this->editAccessPrivate();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Nível de acesso não encontrado.</div>";
        $urlRedirect = URLADM . 'access-level/list-access';
        return header("Location: $urlRedirect");
    }
    
    private function editAccessPrivate()
    {
        if (!empty($this->dados['editAccess'])) {
            unset($this->dados['editAccess']);
            $editAccess = new \Module\administrative\Models\AdmsEditLevelAccess();
            $editAccess->AdmsEditAccess($this->dados);
            if ($editAccess->getResult()) {
                $urlRedirect = URLADM . 'view-level-access/detail-access/' . $this->dados['id'];
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoAccess = new \Module\administrative\Models\AdmsEditLevelAccess();
        $this->dados['form'] = $infoAccess->viewInfoAccess($this->dadoId);
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $button = 
            ['viewAcess' => [
                'menu_controller' => 'view-level-access',
                'menu_metodo' => 'detail-access']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonAcesso'] = $listButton->validateButton($button);

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView("administrative/Views/levelAccess/editLevelAccess", $this->dados);
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Nível de acesso não encontrado.</div>";
        $urlRedirect = URLADM . 'access-level/list-access';
        return header("Location: $urlRedirect");
    }
}
