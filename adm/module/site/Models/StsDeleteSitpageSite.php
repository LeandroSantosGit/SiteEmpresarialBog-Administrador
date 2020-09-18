<?php

namespace Module\site\Models;

if (!defined('URL')){
    header("Location: /");
    exit();
}

/**
 * Description of StsDeleteSitpageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsDeleteSitpageSite
{
    private $dadoId;
    private $result;
    
    function getResult()
    {
        return $this->result;
    }

    public function deletarSituationPageSite($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->checkRegisterPage();
        if ($this->result) {
            $deleteSitPage = new \Module\administrative\Models\helper\AdmsDelete();
            $deleteSitPage->executeDelete(
                    "sts_situacaos_pgs",
                    "WHERE id =:id",
                    "id={$this->dadoId}"
            );
            if ($deleteSitPage->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Situação de"
                        . " pagina do site apagado.</div>";
                return $this->result = true;
            }
            $_SESSION['msg'] = "<div class='alert alert-danger'>Situação de"
                . " pagina do site não apagado.</div>";
            return $this->result = false;
        }
    }
    
    private function checkRegisterPage()
    {
        $viewPage = new \Module\administrative\Models\helper\AdmsRead();
        $viewPage->fullRead(
                "SELECT id
                FROM sts_paginas
                WHERE sts_situacao_pagina_id =:sts_situacao_pagina_id
                LIMIT :limit",
                "sts_situacao_pagina_id={$this->dadoId}&limit=2");
        if ($viewPage->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Situação de página do "
                . "site não pode ser apagado apagado, há páginas cadastrada com essa situação.</div>";
            return $this->result = false;
        }
        return $this->result = true;
    }
}
