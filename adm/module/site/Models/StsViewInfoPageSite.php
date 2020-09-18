<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsViewInfoPageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsViewInfoPageSite
{
    private $result;
    private $dadoId;
    
    public function viewInfoPageSite($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewPage = new \Module\administrative\Models\helper\AdmsRead();
        $viewPage->fullRead(
                "SELECT
                    pg.*,
                    tpg.tipo tipoPage, tpg.nome nomeTipoPg,
                    rob.nome nomeRobot, rob.tipo tipoRobot,
                    sit.nome nomeSitPage,
                    col.cor color
                FROM
                    sts_paginas pg
                INNER JOIN
                    sts_tipos_paginas tpg
                    ON tpg.id = pg.sts_tipos_pagina_id
                INNER JOIN
                    sts_robots rob
                    ON rob.id = pg.sts_robot_id
                INNER JOIN
                    sts_situacaos_pgs sit
                    ON sit.id = pg.sts_situacao_pagina_id
                INNER JOIN
                    adms_cors col
                    ON col.id = sit.adms_cor_id
                WHERE pg.id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewPage->getResult();
        return $this->result;
    }
}
