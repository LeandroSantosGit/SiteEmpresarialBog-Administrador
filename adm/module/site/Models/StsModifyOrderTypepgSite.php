<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsModifyOrderTypepgSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsModifyOrderTypepgSite
{
    private $dadoId;
    private $result;
    private $dados;
    private $typePage;
    private $typePageUnder;
    
    function getResult()
    {
        return $this->result;
    }

    public function alterOrderTypePageSite($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->viewInfoTypePage();
        if ($this->typePage) {
            $this->typePageBottom();
            if ($this->typePageUnder) {
                return $this->moveOrderTypePage();
            }
            $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi 
                    alterado a ordem do tipo de página</div>";
            return $this->Resultado = false;
        }
    }
    
    private function viewInfoTypePage()
    {
        $viewTypePg = new \Module\administrative\Models\helper\AdmsRead();
        $viewTypePg->fullRead(
                "SELECT *
                FROM sts_tipos_paginas
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->typePage = $viewTypePg->getResult();
    }
    
    private function typePageBottom()
    {
        $orderSuper = $this->typePage[0]['ordem'] - 1;
        $viewTypePg = new \Module\administrative\Models\helper\AdmsRead();
        $viewTypePg->fullRead(
                "SELECT id, ordem
                FROM sts_tipos_paginas
                WHERE ordem =:ordem",
                "ordem={$orderSuper}");
        $this->typePageUnder = $viewTypePg->getResult();
    }
    
    private function moveOrderTypePage()
    {
        $this->dados['ordem'] = $this->typePage[0]['ordem'];
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $moveDown = new \Module\administrative\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate(
                "sts_tipos_paginas",
                $this->dados,
                "WHERE id =:id",
                "id={$this->typePageUnder[0]['id']}"
        );
        $this->dados['ordem'] = $this->typePage[0]['ordem'] - 1;
        $moveUp = new \Module\administrative\Models\helper\AdmsUpdate();
        $moveUp->exeUpdate(
                "sts_tipos_paginas",
                $this->dados,
                "WHERE id =:id",
                "id={$this->typePage[0]['id']}"
        );
        if ($moveUp->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Ordem do tipo "
                    . "de página alterarda.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Ordem do tipo "
                . "de página não foi alterada, tente novamente.</div>";
        return $this->result = false;
    }
}
