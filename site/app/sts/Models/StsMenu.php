<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsMenu
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsMenu
{
    private $result;
    
    public function listMenu()
    {
        $list = new \Sts\Models\helper\StsRead();
        $list->fullRead(
                'SELECT
                    endereco,
                    nome_pagina
                FROM
                    sts_paginas
                WHERE
                    lib_bloqueado =:lib_bloqueado
                    AND sts_situacao_pagina_id =:sts_situacao_pagina_id
                ORDER BY
                    ordem_paginas ASC',
                "lib_bloqueado=1&sts_situacao_pagina_id=1");
        $this->result = $list->getResult();
        return $this->result;
    }
}
