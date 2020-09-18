<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditSeo
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditSeo
{
    private $dados;
    
    public function editInfoSeo()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['editInfoSeo'])) {
            unset($this->dados['editInfoSeo']);
            $editSeo = new \Module\site\Models\StsEditSeo();
            $editSeo->alterInfoSeo($this->dados);
            if ($editSeo->getResult()) {
                $urlRedirect = URLADM . 'edit-seo/edit-info-seo';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoSeo = new \Module\site\Models\StsEditSeo();
        $this->dados['form'] = $infoSeo->viewInfoSeo();
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView(
                    "site/Views/seo/editSeo",
                    $this->dados
            );
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Seo "
                . "não encontrado.</div>";
        $urlRedirect = URLADM . 'home/index';
        return header("Location: $urlRedirect");
    }
}
