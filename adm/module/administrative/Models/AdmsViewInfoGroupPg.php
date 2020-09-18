<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsViewInfoGroupPg
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsViewInfoGroupPg
{
    private $dadoId;
    private $result;
    
    public function viewGroupPage($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $groupPg = new \Module\administrative\Models\helper\AdmsRead();
        $groupPg->fullRead(
                "SELECT *
                FROM adms_grupos_paginas
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $groupPg->getResult();
        return $this->result;
    }
}
