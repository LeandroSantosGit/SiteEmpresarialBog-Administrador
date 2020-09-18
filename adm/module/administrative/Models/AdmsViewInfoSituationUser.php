<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsViewInfoSituationUser
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsViewInfoSituationUser
{
    private $result;
    private $dadoId;
    
    public function viewSituationUser($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewSitUser = new \Module\administrative\Models\helper\AdmsRead();
        $viewSitUser->fullRead(
                "SELECT sit.*, col.cor sitCor
                FROM adms_situacao_users sit
                INNER JOIN adms_cors col
                    ON col.id = sit.adms_cor_id
                WHERE sit.id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewSitUser->getResult();
        return $this->result;
    }
}
