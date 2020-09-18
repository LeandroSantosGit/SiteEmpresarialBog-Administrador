<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsViewInfoContact
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsViewInfoContact
{
    private $dadoId;
    private $result;
    
    public function viewInfoMsgContact($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewMsg = new \Module\administrative\Models\helper\AdmsRead();
        $viewMsg->fullRead(
                "SELECT *
                FROM sts_contatos
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewMsg->getResult();
        return $this->result;
    }
}
