<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ModifySituationCarousel
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ModifySituationCarousel
{
    private $dadoId;
    
    public function alterSituationCarousel($dadoId = nulll)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $alterSitCarousel = new \Module\site\Models\StsModifySituationCarousel();
            $alterSitCarousel->alterSituationCarousel($this->dadoId);
        }
        $urlRedirect = URLADM . 'list-carousel/list-carousels';
        return header("Location: $urlRedirect");
    }
}
