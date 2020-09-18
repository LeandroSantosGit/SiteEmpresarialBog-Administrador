<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditMenu
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditMenu
{
    private $dados;
    private $dadoId;
    
    public function editInfoMenu($dadoId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            return $this->editMenuPrivate();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Página não encontrado.</div>";
        $urlRedirect = URLADM . 'list-menu/list-itens-menu';
        return header("Location: $urlRedirect");
    }
    
    private function editMenuPrivate()
    {
        if (!empty($this->dados['editItemMenu'])) {
            unset($this->dados['editItemMenu']);
            $editMenu = new \Module\administrative\Models\AdmsEditMenu();
            $editMenu->alterMenu($this->dados);
            if ($editMenu->getResult()) {
                $urlRedirect = URLADM . 'view-info-menu/detail-info-menu/' . $this->dados['id'];
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoMenu = new \Module\administrative\Models\AdmsEditMenu();
        $this->dados['form'] = $infoMenu->viewInfoMenu($this->dadoId);
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $listSelect = new \Module\administrative\Models\AdmsEditMenu();
            $this->dados['select'] = $listSelect->listRegisterMenu();
            
            $button = 
            ['viewMenu' => [
                'menu_controller' => 'view-info-menu',
                'menu_metodo' => 'detail-info-menu']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsMenu'] = $listButton->validateButton($button);

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView("administrative/Views/menu/editMenu", $this->dados);
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Item do menu não 
                encontrado, tente novamente.</div>";
        $urlRedirect = URLADM . 'list-menu/list-itens-menu';
        return header("Location: $urlRedirect");
    }
}
