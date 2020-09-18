<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsPermission
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsPermission
{
    private $result;
    private $pageId;
    private $limitResult = 20;
    private $resutPage;
    private $levelId;
    
    function getResutPage()
    {
        return $this->resutPage;
    }

    public function listPermission($pageId = null, $levelId = null)
    {
        $this->pageId = (int) $pageId;
        $this->levelId = (int) $levelId;
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(
                URLADM . 'permission/list-permission', "?level=" . $this->levelId);
        $pagination->condition($this->pageId, $this->limitResult);
        $pagination->pagination(
                "SELECT
                    COUNT(nivAcPg.id) numResult
                FROM
                    adms_niveis_acessos_paginas nivAcPg
                INNER JOIN
                    adms_paginas pg
                    ON pg.id = nivAcPg.adms_pagina_id
                INNER JOIN
                    adms_niveis_acessos acce
                    ON acce.id = nivAcPg.adms_niveis_acesso_id
                WHERE
                    nivAcPg.adms_niveis_acesso_id =:adms_niveis_acesso_id
                    AND acce.ordem >=:ordem
                    AND (((
                            SELECT permissao
                            FROM adms_niveis_acessos_paginas
                            WHERE adms_pagina_id = nivAcPg.adms_pagina_id
                                AND adms_niveis_acesso_id = {$_SESSION['userOrdemAcesso']}) = 1)
                        OR (pg.lib_publica = 1))",
                "adms_niveis_acesso_id={$this->levelId}&ordem=" . $_SESSION['userOrdemAcesso']);
        $this->resutPage = $pagination->getResult();
        
        $listuser = new \Module\administrative\Models\helper\AdmsRead();
        $listuser->fullRead(
                "SELECT
                    nivAcPg.id,
                    nivAcPg.permissao,
                    nivAcPg.ordem,
                    nivAcPg.dropdown,
                    nivAcPg.lib_menu,
                    pg.nome_pagina
                FROM
                    adms_niveis_acessos_paginas nivAcPg
                INNER JOIN
                    adms_paginas pg
                    ON pg.id = nivAcPg.adms_pagina_id
                INNER JOIN
                    adms_niveis_acessos acce
                    ON acce.id = nivAcPg.adms_niveis_acesso_id
                WHERE
                    nivAcPg.adms_niveis_acesso_id =:adms_niveis_acesso_id
                    AND acce.ordem >=:ordem
                    AND (((
                            SELECT permissao
                            FROM adms_niveis_acessos_paginas
                            WHERE adms_pagina_id = nivAcPg.adms_pagina_id
                                AND adms_niveis_acesso_id = {$_SESSION['userOrdemAcesso']}) = 1)
                        OR (pg.lib_publica = 1))
                ORDER BY nivAcPg.ordem ASC
                LIMIT :limit
                OFFSET :offset",
                "adms_niveis_acesso_id={$this->levelId}&ordem=" . $_SESSION['userOrdemAcesso'] 
                        . "&limit={$this->limitResult}&offset={$pagination->getOffSet()}");
        $this->result = $listuser->getResult();
        return $this->result;
    }
    
    public function viewLevelAccess($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $levelAccess = new \Module\administrative\Models\helper\AdmsRead();
        $levelAccess->fullRead(
                "SELECT
                    id,
                    nome
                FROM
                    adms_niveis_acessos
                WHERE
                    id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $levelAccess->getResult();
        return $this->result;
    }
}
