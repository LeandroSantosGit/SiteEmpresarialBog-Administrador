<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsViewInfoMenu
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsViewInfoMenu
{
    private $result;
    private $dadoId;
    
    public function viewMenu($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewMenu = new \Module\administrative\Models\helper\AdmsRead();
        $viewMenu->fullRead(
                "SELECT
                    men.*,
                    sit.nome nomeSit,
                    cr.cor cor
                FROM
                    adms_menus men
                INNER JOIN
                    adms_situacao sit
                    ON sit.id = men.adms_situacao_id
                INNER JOIN
                    adms_cors cr
                    ON cr.id = sit.adms_cor_id
                WHERE
                    men.id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewMenu->getResult();
        return $this->result;
    }
}
