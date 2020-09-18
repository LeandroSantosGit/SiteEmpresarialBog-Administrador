<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of DeletePageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class DeletePageSite
{
    public function removePageSite($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $delete = new \Module\site\Models\StsDeletePageSite();
            $delete->deletePageSite($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário "
                    . "selecionar uma página do site.</div>";
        }
        $UrlDestino = URLADM . 'list-page-site/list-info-page-site';
        header("Location: $UrlDestino");
    }
}
