<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditVideo
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditVideo
{
    private $dados;
    
    public function editInfoVideo()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['editVideo'])) {
            unset($this->dados['editVideo']);
            $editVideo = new \Module\site\Models\StsEditVideo();
            $editVideo->alterVideo($this->dados);
            if ($editVideo->getResult()) {
                $urlRedirect = URLADM . 'edit-video/edit-info-video';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoVideo = new \Module\site\Models\StsEditVideo();
        $this->dados['form'] = $infoVideo->viewInfoVideo();
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView(
                    "site/Views/video/editVideo",
                    $this->dados
            );
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Página editar "
                . "vídeo não encontrada.</div>";
        $urlRedirect = URLADM . 'edit-video/edit-info-video';
        return header("Location: $urlRedirect");
    }
}
