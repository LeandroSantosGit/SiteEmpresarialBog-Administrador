<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsViewInfoSitpageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsViewInfoSitpageSite
{
    private $result;
    private $dadoId;
    
    public function viewInfoSituationPageSite($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $situationPage = new \Module\administrative\Models\helper\AdmsRead();
        $situationPage->fullRead(
                "SELECT
                    sitPg.*, col.cor color
                FROM
                    sts_situacaos_pgs sitPg
                INNER JOIN
                    adms_cors col
                    ON col.id = sitPg.adms_cor_id
                WHERE sitPg.id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $situationPage->getResult();
        return $this->result;
    }
}
