<?php

namespace Module\site\Controllers;

if (!defined('URL')){
    header("Location: /");
    exit();
}

/**
 * Description of DeleteSitpageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class DeleteSitpageSite
{
    private $dadoId;
    
    public function removeSitpageSite($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $deleteSitPage = new \Module\site\Models\StsDeleteSitpageSite();
            $deleteSitPage->deletarSituationPageSite($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário "
                    . "selecionar situação de página do site.</div>";
        }
        $UrlDestino = URLADM . 'list-sitpage-site/list-info-sitpage-site';
        header("Location: $UrlDestino");
    }
}
