<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ModifySituationSobCompany
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ModifySituationSobCompany
{
    private $dadoId;
    
    public function alterSituationSobCompany($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $alterSitSobCompany = new \Module\site\Models\StsModifySituationSobCompany();
            $alterSitSobCompany->alterSituationSobCompany($this->dadoId);
        }
        $urlRedirect = URLADM . 'list-sob-company/list-info-company';
        return header("Location: $urlRedirect");
    }
}
