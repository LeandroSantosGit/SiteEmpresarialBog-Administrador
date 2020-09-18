<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of DeleteCarousel
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class DeleteCarousel
{
    private $dadoId;
    
    public function removeCarousel($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $delete = new \Module\site\Models\StsDeleteCarousel();
            $delete->deletarCarousel($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário "
                    . "selecionar um slide do carousel</div>";
        }
        $UrlDestino = URLADM . 'list-carousel/list-carousels';
        header("Location: $UrlDestino");
    }
}
