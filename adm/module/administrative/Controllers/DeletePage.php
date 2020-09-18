<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of DeletePage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class DeletePage
{
    private $dadoId;
    
    public function removePage($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $deletePege = new \Module\administrative\Models\AdmsDeletePage();
            $deletePege->deletePage($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Selecione uma página</div>";
        }
        $urlRedirect = URLADM . 'list-page/list-pages';
        header("Location: $urlRedirect");
    }
}
