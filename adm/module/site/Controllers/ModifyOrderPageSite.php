<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ModifyOrderPageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ModifyOrderPageSite
{
    private $dadoId;
    
    public function alterOrderPageSite($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $orderPage = new \Module\site\Models\StsModifyOrderPageSite();
            $orderPage->alterOrderPageSite($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário 
                    selecionar uma página do site.</div>";
        }
        $urlRedirect = URLADM . 'list-page-site/list-info-page-site';
        return header("Location: $urlRedirect");
    }
}
