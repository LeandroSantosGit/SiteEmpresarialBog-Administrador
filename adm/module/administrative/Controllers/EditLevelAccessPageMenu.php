<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditLevelAccessPageMenu
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditLevelAccessPageMenu
{
    private $dados;
    private $dadoId;
    private $accessId;
    private $pageId;
    
    public function editAccessPgMenu($dadoId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->accessId = filter_input(INPUT_GET, "niv", FILTER_SANITIZE_NUMBER_INT);
        $this->pageId = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId) && ! empty($this->accessId) && ! empty($this->pageId)) {
            $this->editAccessPgMenuPrivate();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>AAItem de menu não encontrado.</div>";
        $urlRedirect = URLADM . 'access-level/list-access';
        header("Location: $urlRedirect");
        }
        
    }
    
    private function editAccessPgMenuPrivate()
    {
        if (!empty($this->dados['editLevelAccePgMenu'])) {
            unset($this->dados['editLevelAccePgMenu']);
            $editmenu = new \Module\administrative\Models\AdmsEditLevelAccessPageMenu();
            $editmenu->modifyMenu($this->dados);
            if ($editmenu->getResult()) {
                $urlRedirect = URLADM . "permission/list-permission/{$this->pageId}?level={$this->accessId}";
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            $this->renderView();
        }
        $levelAccePg = new \Module\administrative\Models\AdmsEditLevelAccessPageMenu();
        $this->dados['form'] = $levelAccePg->levelAccessPage($this->dadoId);
        $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $listSelect = new \Module\administrative\Models\AdmsEditLevelAccessPageMenu();
            $this->dados['select'] = $listSelect->listRegisterPage();

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView("administrative/Views/permission/editLevelAccessPageMenu", $this->dados);
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Item de menu não
                encontrado.</div>";
        $urlRedirect = URLADM . 'access-level/list-access';
        return header("Location: $urlRedirect");
    }
}
