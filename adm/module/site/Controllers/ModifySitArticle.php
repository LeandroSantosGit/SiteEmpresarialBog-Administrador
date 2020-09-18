<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ModifySitArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ModifySitArticle
{
    private $dadoId;
    
    public function alterSitArticle($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $alterSituationArticle = new \Module\site\Models\StsModifySitArticle();
            $alterSituationArticle->alterSituationArticle($this->dadoId);
        }
        $urlRedirect = URLADM . 'list-article/list-info-article';
        return header("Location: $urlRedirect");
    }
}
