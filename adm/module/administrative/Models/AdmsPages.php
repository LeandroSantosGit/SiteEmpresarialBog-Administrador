<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsPages
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsPages
{
    private $result;
    private $urlController;
    private $urlMethod;
    
    public function listPages($urlController = null, $urlMethod = null)
    {
        $this->checkUserAccessLevel();
        $this->urlController = (string) $urlController;
        $this->urlMethod = (string) $urlMethod;
        $listPagesSql = new \Module\administrative\Models\helper\AdmsRead();
        $listPagesSql->fullRead(
            'SELECT
                pag.id, tpg.tipo tipo_pg
            FROM
                adms_paginas pag
            INNER JOIN
                adms_tipos_paginas tpg
                ON tpg.id = pag.adms_tipos_pagina_id
            LEFT JOIN
                adms_niveis_acessos_paginas AS nivpg
                ON nivpg.adms_pagina_id = pag.id
                AND nivpg.adms_niveis_acesso_id =:adms_niveis_acesso_id
            WHERE
                (pag.controller =:controller AND pag.metodo =:metodo)
                AND ((pag.lib_publica =:lib_publica) OR (nivpg.permissao =:permissao))
            LIMIT :limit',
            "adms_niveis_acesso_id={$_SESSION['userAccessLevel']}&controller={$this->urlController}"
            . "&metodo={$this->urlMethod}&lib_publica=1&permissao=1&limit=1");
        $this->result = $listPagesSql->getResult();
        return $this->result;
    }
    
    /** varificar o valor de nivel de acesso */
    private function checkUserAccessLevel()
    {
        if (!isset($_SESSION['userAccessLevel'])) {
            return $_SESSION['userAccessLevel'] = null;
        }
    }
}
