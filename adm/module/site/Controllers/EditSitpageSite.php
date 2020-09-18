<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditSitpageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditSitpageSite
{
    private $dados;
    private $dadoId;
    
    public function editInfoSitpageSite($dadoId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            return $this->editSituationPageSite();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Situação "
                    . "de página do site não encontrado.</div>";
        $urlRedirect = URLADM . 'list-sitpage-site/list-info-sitpage-site';
        return header("Location: $urlRedirect");
    }
    
    private function editSituationPageSite()
    {
        if (!empty($this->dados['editSituationPageSite'])) {
            unset($this->dados['editSituationPageSite']);
            $editSitPage = new \Module\site\Models\StsEditSitpageSite();
            $editSitPage->alterSituationPageSite($this->dados);
            if ($editSitPage->getResult()) {
                $urlRedirect = URLADM 
                        . 'view-info-sitpage-site/detail-info-sitpage-site/'
                        . $this->dados['id'];
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoSitPage = new \Module\site\Models\StsEditSitpageSite();
        $this->dados['form'] = $infoSitPage->viewSituationPageSite($this->dadoId);
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $listSelect = new \Module\site\Models\StsEditSitpageSite();
            $this->dados['select'] = $listSelect->listSituationPageSite();
        
            $button = [
                'viewSitPage' => [
                    'menu_controller' => 'view-info-sitpage-site',
                    'menu_metodo' => 'detail-info-sitpage-site']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsSitPage'] = $listButton->validateButton($button);

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView(
                    "site/Views/situationPageSite/editSitpageSite",
                    $this->dados
            );
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Situação de página "
                . "do site não encontrado.</div>";
        $urlRedirect = URLADM . 'list-sitpage-site/list-info-sitpage-site';
        return header("Location: $urlRedirect");
    }
}
