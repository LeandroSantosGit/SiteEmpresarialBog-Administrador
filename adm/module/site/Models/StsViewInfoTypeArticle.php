<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsViewInfoTypeArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsViewInfoTypeArticle
{
    private $result;
    private $dadoId;
    
    public function viewInfoTypeArticle($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewTpArticle = new \Module\administrative\Models\helper\AdmsRead();
        $viewTpArticle->fullRead(
                "SELECT *
                FROM sts_tps_artigos
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewTpArticle->getResult();
        return $this->result;
    }
}
