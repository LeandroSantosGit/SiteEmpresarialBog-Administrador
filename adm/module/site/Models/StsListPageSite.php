<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsListPageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsListPageSite
{
    private $result;
    private $pageId;
    private $limitResult = 40;
    private $resultPg;
    
    function getResultPg()
    {
        return $this->resultPg;
    }

    public function listPagesSite($pageId = null)
    {
        $this->pageId = (int) $pageId;
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(
                URLADM . 'list-page-site/list-info-page-site');
        $pagination->condition($this->pageId, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) numResult FROM sts_paginas");
        $this->resultPg = $pagination->getResult();
        
        $listPages = new \Module\administrative\Models\helper\AdmsRead();
        $listPages->fullRead(
                "SELECT
                    pg.id, pg.nome_pagina, pg.lib_bloqueado, pg.ordem_paginas,
                    tpg.tipo tipoPage, tpg.nome nomePage,
                    sit.nome nomeSit,
                    col.cor color
                FROM
                    sts_paginas pg
                INNER JOIN
                    sts_tipos_paginas tpg
                    ON tpg.id = pg.sts_tipos_pagina_id
                INNER JOIN
                    sts_situacaos_pgs sit
                    ON sit.id = pg.sts_situacao_pagina_id
                INNER JOIN
                    adms_cors col
                    ON col.id = sit.adms_cor_id
                ORDER BY pg.ordem_paginas ASC
                LIMIT :limit
                OFFSET :offset",
                "limit={$this->limitResult}&offset={$pagination->getOffSet()}");
        $this->result = $listPages->getResult();
        return $this->result;
    }
}
