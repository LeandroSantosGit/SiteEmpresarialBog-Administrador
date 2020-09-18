<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsReleaseMenu
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsReleaseMenu
{
    private $dadoId;
    private $result;
    private $dados;
    private $levelAccessPg;
    
    function getResult()
    {
        return $this->result;
    }

    public function addMenu($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->viewAccessPage();
        if ($this->levelAccessPg) {
            return $this->alterMenu();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi alterado a situação no menu</div>";
        return $this->Resultado = false;
    }
    
    private function viewAccessPage()
    {
        $levelAccePage = new \Module\administrative\Models\helper\AdmsRead();
        $levelAccePage->fullRead(
                "SELECT
                    accPg.id,
                    accPg.lib_menu
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
    
    private function alterMenu()
    {
        if ($this->levelAccessPg[0]['lib_menu'] == 1) {
            $this->dados['lib_menu'] = 2;
        } else {
            $this->dados['lib_menu'] = 1;
        }
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updatPerm = new \Module\administrative\Models\helper\AdmsUpdate();
        $updatPerm->exeUpdate(
                "adms_niveis_acessos_paginas",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dadoId}"
        );
        if ($updatPerm->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>
                    Alterada a situação do menu</div>";
            return $this->Resultado = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>
                Não foi alterada a situação do menu</div>";
        return $this->Resultado = false;
    }
}
