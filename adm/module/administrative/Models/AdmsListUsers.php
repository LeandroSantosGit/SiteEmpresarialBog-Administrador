<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsListUsers
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsListUsers
{
    private $result;
    private $pageId;
    private $limitResult = 10;
    private $resultPage;
    
    function getResultPage()
    {
        return $this->resultPage;
    }
    
    function getResult()
    {
        return $this->result;
    }

    public function listUsers($pageId = null)
    {
        $this->pageId = (int) $pageId;
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(
                URLADM . 'users/list-users');
        $pagination->condition($this->pageId, $this->limitResult);
        $pagination->pagination(
                "SELECT COUNT(user.id) numResult
                FROM
                    adms_usuarios user
                INNER JOIN
                    adms_niveis_acessos nivac
                    ON nivac.id = user.adms_niveis_acesso_id
                WHERE
                    nivac.ordem >=:ordem",
                "ordem=" . $_SESSION['userOrdemAcesso']);
        $this->resultPage = $pagination->getResult();
        
        $listuser = new \Module\administrative\Models\helper\AdmsRead();
        $listuser->fullRead(
                "SELECT
                    user.id,
                    user.nome,
                    user.email,
                    sit.nome situacaoUser,
                    cr.cor
                FROM
                    adms_usuarios user
                INNER JOIN
                    adms_situacao sit
                    ON sit.id = user.adms_situacao_user_id
                INNER JOIN
                    adms_cors cr
                    ON cr.id = sit.adms_cor_id
                INNER JOIN
                    adms_niveis_acessos nivac
                    ON nivac.id = user.adms_niveis_acesso_id
                WHERE
                    nivac.ordem >=:ordem
                ORDER BY id DESC
                LIMIT :limit
                OFFSET :offset",
                "ordem=" . $_SESSION['userOrdemAcesso']
                . "&limit={$this->limitResult}&offset={$pagination->getOffSet()}");
        $this->result = $listuser->getResult();
        return $this->result;
    }
}
