<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsViewInfoColor
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsViewInfoColor
{
    private $result;
    private $dadoId;
    
    public function viewColor($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $color = new \Module\administrative\Models\helper\AdmsRead();
        $color->fullRead(
                "SELECT *
                FROM adms_cors
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $color->getResult();
        return $this->result;
    }
}
