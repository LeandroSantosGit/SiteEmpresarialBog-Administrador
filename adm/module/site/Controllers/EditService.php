<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditService
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditService
{
    private $dados;
    
    public function editInfoServices()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['editServices'])) {
            unset($this->dados['editServices']);
            $editServices = new \Module\site\Models\StsEditService();
            $editServices->alterServices($this->dados);
            if ($editServices->getResult()) {
                $urlRedirect = URLADM . 'edit-service/edit-info-services';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoServices = new \Module\site\Models\StsEditService();
        $this->dados['form'] = $infoServices->viewInfoServices();
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView(
                    "site/Views/service/editService",
                    $this->dados
            );
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Página editar "
                . "vídeo não encontrada.</div>";
        $urlRedirect = URLADM . 'edit-service/edit-info-services';
        return header("Location: $urlRedirect");
    }
}
