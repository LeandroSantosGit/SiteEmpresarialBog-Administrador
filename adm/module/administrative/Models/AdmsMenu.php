<?php

namespace Module\administrative\Models;

if (!defined("URL")) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsMenu
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsMenu
{
    private $result;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function itemMenu()
    {
        $listMenu = new \Module\administrative\Models\helper\AdmsRead();
        $listMenu->fullRead(
                "SELECT
                    nivpg.dropdown,
                    men.id id_menu,
                    men.nome nome_menu,
                    men.icone icone_menu,
                    pg.id id_pg,
                    pg.menu_controller pg_controller,
                    pg.menu_metodo pg_metodo,
                    pg.nome_pagina pg_nome,
                    pg.icone pg_icon
                FROM
                    adms_niveis_acessos_paginas nivpg
                INNER JOIN
                    adms_menus men
                    ON men.id = nivpg.adms_menu_id
                INNER JOIN
                    adms_paginas pg
                    ON pg.id = nivpg.adms_pagina_id
                WHERE
                    nivpg.adms_niveis_acesso_id =:adms_niveis_acesso_id
                    AND nivpg.permissao =:permissao
                    AND nivpg.lib_menu =:lib_menu
                ORDER BY
                    men.ordem, nivpg.ordem ASC",
                "adms_niveis_acesso_id=" . $_SESSION['userAccessLevel'] . "&permissao=1&lib_menu=1");
        $this->result = $listMenu->getResult();
        return $this->result;
    }
}
