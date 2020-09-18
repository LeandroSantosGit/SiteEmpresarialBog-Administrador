<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsSearchUser
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsSearchUser
{
    private $result;
    private $pageId;
    private $limitResult = 1;
    private $resultPage;
    private $dadosForm;
    
    function getResultPage()
    {
        return $this->resultPage;
    }
    
    function getResult()
    {
        return $this->result;
    }

    public function listSearchedUser($pageId = null, $dadosForm = null)
    {
        $this->pageId = (int) $pageId;
        $this->dadosForm = $dadosForm;
        $this->dadosForm['nome'] = trim($this->dadosForm['nome']);
        $this->dadosForm['email'] = trim($this->dadosForm['email']);
        $_SESSION['searchUserName'] = $this->dadosForm['nome'];
        $_SESSION['searchUserEmail'] = $this->dadosForm['email'];
        
        if (!empty($this->dadosForm['nome']) && !empty($this->dadosForm['email'])) {
            $this->searchUserByNameAndEmail();
        } elseif (!empty($this->dadosForm['nome'])) {
            $this->searchUserByName();
        } elseif (!empty($this->dadosForm['email'])) {
            $this->searchUserByEmail();
        }
        return $this->result;
    }
    
    private function searchUserByNameAndEmail()
    {
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(
                URLADM . 'search-user/list-users-searched',
                "?nome={$this->dadosForm['nome']}&email={$this->dadosForm['email']}"
        );
        $pagination->condition($this->pageId, $this->limitResult);
        $pagination->pagination(
                "SELECT COUNT(user.id) numResult
                FROM
                    adms_usuarios user
                INNER JOIN
                    adms_niveis_acessos nivac
                    ON nivac.id = user.adms_niveis_acesso_id
                WHERE
                    nivac.ordem >=:ordem
                    AND (user.nome LIKE '%' :nome '%' OR user.email LIKE '%' :email '%')",
                "ordem=" . $_SESSION['userOrdemAcesso']
                . "&nome={$this->dadosForm['nome']}"
                . "&email={$this->dadosForm['email']}");
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
                    AND (user.nome LIKE '%' :nome '%' OR user.email LIKE '%' :email '%')
                ORDER BY id DESC
                LIMIT :limit
                OFFSET :offset",
                "ordem=" . $_SESSION['userOrdemAcesso']
                . "&nome={$this->dadosForm['nome']}"
                . "&email={$this->dadosForm['email']}"
                . "&limit={$this->limitResult}"
                . "&offset={$pagination->getOffSet()}");
        $this->result = $listuser->getResult();
    }


    private function searchUserByName()
    {
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(
                URLADM . 'search-user/list-users-searched',
                "?nome={$this->dadosForm['nome']}"
        );
        $pagination->condition($this->pageId, $this->limitResult);
        $pagination->pagination(
                "SELECT COUNT(user.id) numResult
                FROM
                    adms_usuarios user
                INNER JOIN
                    adms_niveis_acessos nivac
                    ON nivac.id = user.adms_niveis_acesso_id
                WHERE
                    nivac.ordem >=:ordem
                    AND user.nome LIKE '%' :nome '%'",
                "ordem=" . $_SESSION['userOrdemAcesso'] . "&nome={$this->dadosForm['nome']}");
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
                    AND user.nome LIKE '%' :nome '%'
                ORDER BY id DESC
                LIMIT :limit
                OFFSET :offset",
                "ordem=" . $_SESSION['userOrdemAcesso']
                . "&nome={$this->dadosForm['nome']}"
                . "&limit={$this->limitResult}"
                . "&offset={$pagination->getOffSet()}");
        $this->result = $listuser->getResult();
    }
    
    private function searchUserByEmail()
    {
        $pagination = new \Module\administrative\Models\helper\AdmsPagination(
                URLADM . 'search-user/list-users-searched',
                "?email={$this->dadosForm['email']}"
        );
        $pagination->condition($this->pageId, $this->limitResult);
        $pagination->pagination(
                "SELECT COUNT(user.id) numResult
                FROM
                    adms_usuarios user
                INNER JOIN
                    adms_niveis_acessos nivac
                    ON nivac.id = user.adms_niveis_acesso_id
                WHERE
                    nivac.ordem >=:ordem
                    AND user.email LIKE '%' :email '%'",
                "ordem=" . $_SESSION['userOrdemAcesso'] . "&email={$this->dadosForm['email']}");
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
                    AND user.email LIKE '%' :email '%'
                ORDER BY id DESC
                LIMIT :limit
                OFFSET :offset",
                "ordem=" . $_SESSION['userOrdemAcesso']
                . "&email={$this->dadosForm['email']}"
                . "&limit={$this->limitResult}"
                . "&offset={$pagination->getOffSet()}");
        $this->result = $listuser->getResult();
    }

    

    private function naoUsado()
    {
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
    }
}
