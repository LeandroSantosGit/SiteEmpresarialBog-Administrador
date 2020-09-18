<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsViewInfoPage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsViewInfoPage
{
    private $result;
    private $dadoId;
    
    public function viewPage($dadosId)
    {
        $this->dadoId = (int) $dadosId;
        $viewPage = new \Module\administrative\Models\helper\AdmsRead();
        $viewPage->fullRead(
                "SELECT
                    pg.*,
                    grPg.nome nomeGru,
                    tpPg.tipo tipoTip, tpPg.nome nomeTip,
                    sitPg.nome nomeSit, sitPg.cor corSit
                FROM
                    adms_paginas pg
                INNER JOIN
                    adms_grupos_paginas grPg
                    ON grPg.id = pg.adms_grupo_pagina_id
                INNER JOIN
                    adms_tipos_paginas tpPg
                    ON tpPg.id = pg.adms_tipos_pagina_id
                INNER JOIN
                    adms_situacao_paginas sitPg
                    ON sitPg.id = pg.adms_situacao_pagina_id
                WHERE pg.id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewPage->getResult();
        return $this->result;
    }
}
