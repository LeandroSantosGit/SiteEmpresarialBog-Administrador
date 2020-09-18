<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsModifyOrderTypePage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsModifyOrderTypePage
{
    private $dadoId;
    private $result;
    private $dados;
    private $dadosTypePg;
    private $dadoTypePgUnder;
    
    function getResult()
    {
        return $this->result;
    }

    public function moveOrderTypePage($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->viewInfoTypePage($this->dadoId);
        if ($this->dadosTypePg) {
            $this->typePgBottom();
            if ($this->dadoTypePgUnder) {
                $this->moveTypePg();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi 
                        alterado a ordem do tipo de páginas</div>";
                $this->Resultado = false;
            }
        }
    }
    
    private function viewInfoTypePage()
    {
        $typePg = new \Module\administrative\Models\helper\AdmsRead();
        $typePg->fullRead(
                "SELECT *
                FROM adms_tipos_paginas
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->dadosTypePg = $typePg->getResult();
    }
    
    private function typePgBottom()
    {
        $orderSuper = $this->dadosTypePg[0]['ordem'] - 1;
        $viewTypePG = new \Module\administrative\Models\helper\AdmsRead();
        $viewTypePG->fullRead(
                "SELECT id, ordem
                FROM adms_tipos_paginas
                WHERE ordem =:ordem",
                "ordem={$orderSuper}");
        $this->dadoTypePgUnder = $viewTypePG->getResult();
    }
    
    private function moveTypePg()
    {
        $this->dados['ordem'] = $this->dadosTypePg[0]['ordem'];
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $moveDown = new \Module\administrative\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate(
                "adms_tipos_paginas",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dadoTypePgUnder[0]['id']}"
        );
        $this->dados['ordem'] = $this->dadosTypePg[0]['ordem'] - 1;
        $moveUp = new \Module\administrative\Models\helper\AdmsUpdate();
        $moveUp->exeUpdate(
                "adms_tipos_paginas",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dadosTypePg[0]['id']}"
        );
        if ($moveUp->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Ordem do tipo "
                    . "de páginas alterarda.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Ordem do tipo de páginas
                não foi alterada, tente novamente.</div>";
        return $this->result = false;
    }
}
