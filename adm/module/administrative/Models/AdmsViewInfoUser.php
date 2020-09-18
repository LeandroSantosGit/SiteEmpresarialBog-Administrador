<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit(); 
}

/**
 * Description of AdmsViewInfoUser
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsViewInfoUser
{
    private $result;
    private $dadoId;
    
    function getResult()
    {
        return $this->result;
    }

    public function viewInfoUser($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $profileUser = new \Module\administrative\Models\helper\AdmsRead();
        $profileUser->fullRead(
                "SELECT
                    user.*,
                    nivac.nome nomeNivel,
                    sit.nome nomeSituacao,
                    cr.cor cor
                FROM
                    adms_usuarios user
                INNER JOIN
                    adms_niveis_acessos nivac
                    ON nivac.id = user.adms_niveis_acesso_id
                INNER JOIN
                    adms_situacao_users sit
                    ON sit.id = user.adms_situacao_user_id
                INNER JOIN
                    adms_cors cr
                    ON cr.id = sit.adms_cor_id
                WHERE user.id =:id
                      AND nivac.ordem >=:ordem
                LIMIT :limit", 
                "id={$this->dadoId}&ordem=" . $_SESSION['userOrdemAcesso'] . "&limit=1");
        $this->result = $profileUser->getResult();
        return $this->result;
    }
}
