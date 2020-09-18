<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsViewInfoTypepgSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsViewInfoTypepgSite
{
    private $result;
    private $dadoId;
    
    public function viewInfoTypePageSite($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewTypePg = new \Module\administrative\Models\helper\AdmsRead();
        $viewTypePg->fullRead(
                "SELECT *
                FROM sts_tipos_paginas
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewTypePg->getResult();
        return $this->result;
    }
}
