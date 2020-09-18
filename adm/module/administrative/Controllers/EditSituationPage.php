<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditSituationPage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditSituationPage
{
    private $dadoId;
    private $dados;
    
    public function editInfoSituationPage($dadoId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            return $this->editSituationPagePrivate();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Situação de "
                . "página não encontrada.</div>";
        $urlRedirect = URLADM . 'list-situation-page/list-situation-pages';
        return header("Location: $urlRedirect");
    }
    
    private function editSituationPagePrivate()
    {
        if (!empty($this->dados['editSituationPage'])) {
            unset($this->dados['editSituationPage']);
            $editSitPg = new \Module\administrative\Models\AdmsEditSituationPage();
            $editSitPg->alterSituationPage($this->dados);
            if ($editSitPg->getResult()) {
                $urlRedirect = URLADM 
                        . 'view-info-situation-page/'
                        . 'detail-info-situation-page/'
                        . $this->dados['id'];
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoSitPg = new \Module\administrative\Models\AdmsEditSituationPage();
        $this->dados['form'] = $infoSitPg->viewInfoSituationPage($this->dadoId);
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $button = [
                'viewSitPage' => [
                    'menu_controller' => 'view-info-situation-page',
                    'menu_metodo' => 'detail-info-situation-page']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonSitPage'] = $listButton->validateButton($button);

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView(
                    "administrative/Views/situationPage/editSituationPage",
                    $this->dados
            );
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Situação de "
                . "página não encontrada.</div>";
        $urlRedirect = URLADM . 'list-situation-page/list-situation-pages';
        return header("Location: $urlRedirect");
    }
}
