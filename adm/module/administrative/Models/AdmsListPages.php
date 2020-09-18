<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsListPages
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsListPages
{
    private $result;
    private $pageId;
    private $limitResult = 40;
    private $resultPage;
    
    function getResultPage()
    {
        return $this->resultPage;
    }

    public function listPages($pageId = null)
    {
        $this->pageId = (int) $pageId;
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(URLADM . 'list-page/list-pages');
        $pagination->condition($this->pageId, $this->limitResult);
        $pagination->pagination(
                "SELECT COUNT(id) numResult
                FROM adms_paginas");
        $this->resultPage = $pagination->getResult();
        
        $listPages = new \Module\administrative\Models\helper\AdmsRead();
        $listPages->fullRead(
                "SELECT
                    pg.id,
                    pg.nome_pagina pgNome,
                    tip.tipo tipoPg,
                    tip.nome tipoNome,
                    sit.nome sitNome,
                    sit.cor sitCor
                FROM
                    adms_paginas pg
                INNER JOIN 
                    adms_tipos_paginas tip
                    ON tip.id = pg.adms_tipos_pagina_id
                INNER JOIN
                    adms_situacao_paginas sit
                    ON sit.id = adms_situacao_pagina_id
                ORDER BY id DESC
                LIMIT :limit
                OFFSET :offset",
                "limit={$this->limitResult}&offset={$pagination->getOffSet()}");
        $this->result = $listPages->getResult();
        return $this->result;
    }
}
