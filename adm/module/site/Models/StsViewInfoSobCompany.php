<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsviewInfoSobCompany
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsviewInfoSobCompany
{
    private $result;
    private $dadoId;
    
    public function viewInfoSobCompany($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $sobCompany = new \Module\administrative\Models\helper\AdmsRead();
        $sobCompany->fullRead(
                "SELECT
                    emp.*, sit.nome nomeSit, col.cor color
                FROM
                    sts_sob_empresa emp
                INNER JOIN
                    adms_situacao sit 
                    ON sit.id = emp.adms_sit_id
                INNER JOIN
                    adms_cors col
                    ON col.id = sit.adms_cor_id
                WHERE emp.id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $sobCompany->getResult();
        return $this->result;
    }
}
