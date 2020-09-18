<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsDeleteSituationPage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsDeleteSituationPage
{
    private $dadoId;
    private $result;
    
    function getResult()
    {
        return $this->result;
    }

    public function deleteSituationPage($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->checkRegisterSituationPage();
        if ($this->result) {
            $delete = new \Module\administrative\Models\helper\AdmsDelete();
            $delete->executeDelete(
                    "adms_situacao_paginas",
                    "WHERE id =:id",
                    "id={$this->dadoId}"
            );
            if ($delete->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Situação"
                        . " página apagado.</div>";
                return $this->result = true;
            }
            $_SESSION['msg'] = "<div class='alert alert-danger'>Situação "
                    . "página não apagado.</div>";
            return $this->result = false;
        }
    }
    
    private function checkRegisterSituationPage()
    {
        $checkSitPg = new \Module\administrative\Models\helper\AdmsRead();
        $checkSitPg->fullRead(
                "SELECT id
                FROM adms_paginas
                WHERE adms_situacao_pagina_id =:adms_situacao_pagina_id
                LIMIT :limit", 
                "adms_situacao_pagina_id={$this->dadoId}&limit=2");
        if ($checkSitPg->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Situação página não
                    pode ser apagado, há páginas cadastradas nesta situação.</div>";
            return $this->result = false;
        }
        return $this->result = true;
    }
}
