<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ModifySitPageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ModifySitPageSite
{
    private $dadoId;
    
    public function alterSitPageSite($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $alterSituationPage = new \Module\site\Models\StsModifySitPageSite();
            $alterSituationPage->alterSituationPageSite($this->dadoId);
        }
        $urlRedirect = URLADM . 'list-page-site/list-info-page-site';
        return header("Location: $urlRedirect");
    }
}
