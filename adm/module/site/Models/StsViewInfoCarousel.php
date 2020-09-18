<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location");
    exit();
}

/**
 * Description of StsViewInfoCarousel
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsViewInfoCarousel
{
    private $dadoId;
    private $result;
    
    public function viewInfoCarousel($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewCarousel = new \Module\administrative\Models\helper\AdmsRead();
        $viewCarousel->fullRead(
                "SELECT car.*, sit.nome nomeSit, col.cor color, cor.cor corBtn
                FROM sts_carousels car
                INNER JOIN adms_cors col
                    ON col.id = car.adms_cor_id
                INNER JOIN adms_situacao sit
                    ON sit.id = car.adms_situacoes_id
                INNER JOIN 
                    adms_cors cor
                    ON cor.id = sit.adms_cor_id
                WHERE car.id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewCarousel->getResult();
        return $this->result;
    }
}
