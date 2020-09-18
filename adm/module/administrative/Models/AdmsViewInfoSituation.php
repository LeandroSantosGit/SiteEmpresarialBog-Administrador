<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsViewInfoSituation
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsViewInfoSituation
{
    private $result;
    private $dadoId;
    
    public function viewSituation($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $situation = new \Module\administrative\Models\helper\AdmsRead();
        $situation->fullRead(
                "SELECT sit.*, col.cor sitCor 
                FROM adms_situacao sit
                INNER JOIN adms_cors col
                    ON col.id = sit.adms_cor_id
                WHERE sit.id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $situation->getResult();
        return $this->result;
    }
}
