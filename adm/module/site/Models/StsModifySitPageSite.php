<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsModifySitPageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsModifySitPageSite
{
    private $dadoId;
    private $result;
    private $dados;
    private $dadosPage;
    
    function getResult()
    {
        return $this->result;
    }

    public function alterSituationPageSite($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->viewPageSite();
        if ($this->dadosPage) {
            return $this->updateSituationPageSite();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi 
                alterada a situação da página do site.</div>";
        return $this->Resultado = false;
    }
    
    private function viewPageSite()
    {
        $viewPage = new \Module\administrative\Models\helper\AdmsRead();
        $viewPage->fullRead(
                "SELECT id, sts_situacao_pagina_id
                FROM sts_paginas
                WHERE id =:id",
                "id=$this->dadoId");
        $this->dadosPage = $viewPage->getResult();
    }
    
    private function updateSituationPageSite()
    {
        if ($this->dadosPage[0]['sts_situacao_pagina_id'] == 1) {
            $this->dados['sts_situacao_pagina_id'] = 2;
        } else {
            $this->dados['sts_situacao_pagina_id'] = 1;
        }
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateSitPage = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateSitPage->exeUpdate(
                "sts_paginas",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dadoId}"
        );
        if ($updateSitPage->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação da "
                    . "página alterarda.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Situação da "
                . "página não foi alterada, tente novamente.</div>";
        return $this->result = false;
    }
}
