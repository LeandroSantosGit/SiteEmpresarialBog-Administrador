<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsViewInfoTypePage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsViewInfoTypePage
{
    private $result;
    private $dadoId;
    
    public function viewTypePage($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $typePage = new \Module\administrative\Models\helper\AdmsRead();
        $typePage->fullRead(
                "SELECT *
                FROM adms_tipos_paginas
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $typePage->getResult();
        return $this->result;
    }
}
