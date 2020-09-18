<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ModifyOrderTypepgSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ModifyOrderTypepgSite
{
    private $dadoId;
    
    public function alterOrderTypepgSite($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $alterOrderTypePg = new \Module\site\Models\StsModifyOrderTypepgSite();
            $alterOrderTypePg->alterOrderTypePageSite($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário 
                    selecionar um tipo de página.</div>";
        }
        $urlRedirect = URLADM . 'list-typepg-site/list-info-typepg-site';
        return header("Location: $urlRedirect");
    }
}
