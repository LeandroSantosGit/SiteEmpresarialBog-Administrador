<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ModifyOrderCarousel
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ModifyOrderCarousel
{
    private $dadoId;
    
    public function alterOrderCarousel($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $orderCarousel = new \Module\site\Models\StsModifyOrderCarousel();
            $orderCarousel->moveOrderCarousel($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário 
                    selecionar um slide de carousel</div>";
        }
        $urlRedirect = URLADM . 'list-carousel/list-carousels';
        return header("Location: $urlRedirect");
    }
}
