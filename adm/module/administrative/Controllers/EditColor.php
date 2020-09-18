<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditColor
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditColor
{
    private $dados;
    private $dadoId;
    
    public function editInfoColor($dadoId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            return $this->editColorPrivate();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Cor não encontrada.</div>";
        $urlRedirect = URLADM . 'list-color/list-colors';
        return header("Location: $urlRedirect");
    }
    
    private function editColorPrivate()
    {
        if (!empty($this->dados['editColor'])) {
            unset($this->dados['editColor']);
            $editCor = new \Module\administrative\Models\AdmsEditColor();
            $editCor->alterColor($this->dados);
            if ($editCor->getResult()) {
                $urlRedirect = URLADM . 'view-info-color/detail-info-color/' . $this->dados['id'];
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoColor = new \Module\administrative\Models\AdmsEditColor();
        $this->dados['form'] = $infoColor->viewInfoColor($this->dadoId);
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $button = [
                'viewColor' => [
                    'menu_controller' => 'view-info-color',
                    'menu_metodo' => 'detail-info-color']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsColor'] = $listButton->validateButton($button);

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView("administrative/Views/colors/editColor", $this->dados);
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Cor não 
                encontrada.</div>";
        $urlRedirect = URLADM . 'list-color/list-colors';
        return header("Location: $urlRedirect");
    }
}
