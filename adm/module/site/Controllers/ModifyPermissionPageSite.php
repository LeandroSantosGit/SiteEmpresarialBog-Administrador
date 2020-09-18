<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ModifyPermissionPageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ModifyPermissionPageSite
{
    private $dadoId;
    
    public function alterPermissionPageSite($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $alterConditionMenu = new \Module\site\Models\StsModifyPermissionPageSite();
            $alterConditionMenu->alterPageSiteMenuReleaseAndBlock($this->dadoId);
        }
        $urlRedirect = URLADM . 'list-page-site/list-info-page-site';
        return header("Location: $urlRedirect");
    }
}
