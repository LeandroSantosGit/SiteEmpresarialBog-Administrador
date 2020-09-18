<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of DeleteTypepgSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class DeleteTypepgSite
{
    private $dadoId;
    
    public function removeTypepgSite($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $deleteTypePg = new \Module\site\Models\StsDeleteTypepgSite();
            $deleteTypePg->deleteTypePageSite($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário "
                    . "selecionar um tipo de página.</div>";
        }
        $UrlDestino = URLADM . 'list-typepg-site/list-info-typepg-site';
        header("Location: $UrlDestino");
    }
}
