<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsViewInfoSituationPage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsViewInfoSituationPage
{
    private $result;
    private $dadoId;
    
    public function viewInfoSituationPage($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewSitPg = new \Module\administrative\Models\helper\AdmsRead();
        $viewSitPg->fullRead(
                "SELECT *
                FROM adms_situacao_paginas
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewSitPg->getResult();
        return $this->result;
    }
}
