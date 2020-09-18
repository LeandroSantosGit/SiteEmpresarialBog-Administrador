<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsModifyOrderMenu
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsModifyOrderMenu
{
    private $dadoId;
    private $result;
    private $dados;
    private $levelAccessPg;
    private $accesPrevious;
    
    function getResult()
    {
        return $this->result;
    }

    public function moveOrderMenu($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->viewAccessPage();
        if ($this->levelAccessPg) {
            $this->accessPagePrevious();
            $this->moveMenu();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi alterado a ordem no menu</div>";
            $this->Resultado = false;
        }
    }
    
    private function viewAccessPage()
    {
        $levelAccePage = new \Module\administrative\Models\helper\AdmsRead();
        $levelAccePage->fullRead(
                "SELECT
                    accPg.id,
                    accPg.ordem,
                    accPg.adms_niveis_acesso_id
                FROM
                    adms_niveis_acessos_paginas accPg
                INNER JOIN
                    adms_niveis_acessos niAce
                    ON niAce.id = accPg.adms_niveis_acesso_id
                WHERE 
                    accPg.id =:id
                    AND niAce.ordem >=:ordem",
                "id={$this->dadoId}&ordem=" . $_SESSION['userOrdemAcesso']);
        $this->levelAccessPg = $levelAccePage->getResult();
    }
    
    private function accessPagePrevious()
    {
        $orderSuper = $this->levelAccessPg[0]['ordem'] - 1;
        $accessPageId = $this->levelAccessPg[0]['adms_niveis_acesso_id'];
        $viewAccess = new \Module\administrative\Models\helper\AdmsRead();
        $viewAccess->fullRead(
                "SELECT id, ordem, adms_niveis_acesso_id
                FROM adms_niveis_acessos_paginas
                WHERE ordem =:ordem 
                      AND adms_niveis_acesso_id =:adms_niveis_acesso_id",
                "ordem={$orderSuper}&adms_niveis_acesso_id={$accessPageId}");
        $this->accesPrevious = $viewAccess->getResult();
    }


    private function moveMenu()
    {
        $this->dados['ordem'] = $this->levelAccessPg[0]['ordem'];
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $moveDown = new \Module\administrative\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate(
                "adms_niveis_acessos_paginas",
                $this->dados,
                "WHERE id =:id",
                "id={$this->accesPrevious[0]['id']}"
        );
        $this->dados['ordem'] = $this->levelAccessPg[0]['ordem'] - 1;
        $moveUp = new \Module\administrative\Models\helper\AdmsUpdate();
        $moveUp->exeUpdate(
                "adms_niveis_acessos_paginas",
                $this->dados,
                "WHERE id =:id",
                "id={$this->levelAccessPg[0]['id']}"
        );
        if ($moveUp->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Ordem do menu alterarda.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Ordem do menu
                não foi alterada, tente novamente.</div>";
        return $this->result = false;
    }
}
