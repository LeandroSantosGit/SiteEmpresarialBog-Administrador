<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsHome
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsCarouselHome
{
    private $result;
    
    public function listCarouselHome()
    {
        $listar = new \Sts\Models\helper\StsRead();
        $listar->fullRead(
                "SELECT
                    car.id,
                    car.nome,
                    car.imagem,
                    car.titulo,
                    car.descricao,
                    car.posicao_text,
                    car.titulo_botao,
                    car.link,
                    cors.cor
                FROM
                    sts_carousels car
                INNER JOIN
                    adms_cors cors
                    ON cors.id = car.adms_cor_id                
                WHERE
                    adms_situacoes_id =:adms_situacoes_id
                ORDER BY
                    ordem ASC
                LIMIT :limit",
                    "adms_situacoes_id=1&limit=6");
        $this->result['sts_carousels'] = $listar->getResult();
        return $this->result['sts_carousels'];
    }
}
