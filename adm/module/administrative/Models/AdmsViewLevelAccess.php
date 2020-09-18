<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit(); 
}

/**
 * Description of AdmsViewLevelAccess
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsViewLevelAccess
{
    private $result;
    private $dadoId;
    
    public function detailInfoAcess($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewAcess = new \Module\administrative\Models\helper\AdmsRead();
        $viewAcess->fullRead(
                "SELECT *
                FROM adms_niveis_acessos
                WHERE id =:id AND ordem >=:ordem
                LIMIT :limit",
                "id={$this->dadoId}&ordem=" . $_SESSION['userOrdemAcesso'] . "&limit=1");
        $this->result = $viewAcess->getResult();
        return $this->result;
    }
}
