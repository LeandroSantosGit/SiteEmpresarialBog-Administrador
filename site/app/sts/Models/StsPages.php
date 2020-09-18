<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsPages
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsPages
{
    private $result;
    private $urlController;
    
    public function listPages($urlController = null)
    {
        $this->urlController = (string) $urlController;
        $listPagesSql = new \Sts\Models\helper\StsRead();
        $listPagesSql->fullRead(
                'SELECT
                    pag.id,
                    tpg.tipo AS tipo_tpg
                FROM
                    sts_paginas AS pag
                INNER JOIN
                    sts_tipos_paginas AS tpg
                    ON tpg.id = pag.sts_tipos_pagina_id
                WHERE
                    pag.sts_situacao_pagina_id =:sts_situacao_pagina_id
                    AND pag.controller =:controller
                LIMIT :limit',
                "sts_situacao_pagina_id=1&controller={$this->urlController}&limit=1");
        $this->result = $listPagesSql->getResult();
        return $this->result;
    }
}
