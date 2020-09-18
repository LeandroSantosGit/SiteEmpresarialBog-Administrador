<?php

namespace Module\administrative\Models;

if (!defined("URL")) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsButton
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsButton
{
    private $result;
    private $button;
    private $buttonValid = [];
    
    function getResult()
    {
        return $this->result;
    }
    
    public function validateButton(array $button)
    {
        $this->button = $button;
        foreach ($this->button as $key => $buttonUnique) {
            extract($buttonUnique);
            $viewButton = new \Module\administrative\Models\helper\AdmsRead();
            $viewButton->fullRead(
                    "SELECT
                        pg.id idPg
                    FROM
                        adms_paginas pg
                    LEFT JOIN
                        adms_niveis_acessos_paginas nivpg
                        ON nivpg.adms_pagina_id = pg.id
                    WHERE
                        pg.menu_controller =:menu_controller
                        AND pg.menu_metodo =:menu_metodo
                        AND pg.adms_situacao_pagina_id = 1
                        AND nivpg.adms_niveis_acesso_id =:adms_niveis_acesso_id
                        AND nivpg.permissao = 1
                    LIMIT :limit",
                    "menu_controller=$menu_controller&menu_metodo=$menu_metodo"
                    . "&adms_niveis_acesso_id=" . $_SESSION['userAccessLevel'] . "&limit=1");
            if ($viewButton->getResult()) {
                $this->buttonValid[$key] = true;
            } else {
                $this->buttonValid[$key] = false;
            }
        }
        return $this->buttonValid;
    }
}
