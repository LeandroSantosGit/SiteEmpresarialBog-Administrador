<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsModifyOrderGroupPg
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsModifyOrderGroupPg
{
    private $dadoId;
    private $result;
    private $dados;
    private $dadosGroupPg;
    private $dadoGroupPgUnder;
    
    function getResult()
    {
        return $this->result;
    }

    public function moveOrderGroupPage($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->viewInfoGroupPage($this->dadoId);
        if ($this->dadosGroupPg) {
            $this->groupPgBottom();
            if ($this->dadoGroupPgUnder) {
                $this->moveGroupPg();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi 
                        alterado a ordem do grupo de páginas</div>";
                $this->Resultado = false;
            }
        }
    }
    
    private function viewInfoGroupPage()
    {
        $groupPg = new \Module\administrative\Models\helper\AdmsRead();
        $groupPg->fullRead(
                "SELECT *
                FROM adms_grupos_paginas
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->dadosGroupPg = $groupPg->getResult();
    }
    
    private function groupPgBottom()
    {
        $orderSuper = $this->dadosGroupPg[0]['ordem'] - 1;
        $viewGroupPG = new \Module\administrative\Models\helper\AdmsRead();
        $viewGroupPG->fullRead(
                "SELECT id, ordem
                FROM adms_grupos_paginas
                WHERE ordem =:ordem",
                "ordem={$orderSuper}");
        $this->dadoGroupPgUnder = $viewGroupPG->getResult();
    }
    
    private function moveGroupPg()
    {
        $this->dados['ordem'] = $this->dadosGroupPg[0]['ordem'];
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $moveDown = new \Module\administrative\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate(
                "adms_grupos_paginas",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dadoGroupPgUnder[0]['id']}"
        );
        $this->dados['ordem'] = $this->dadosGroupPg[0]['ordem'] - 1;
        $moveUp = new \Module\administrative\Models\helper\AdmsUpdate();
        $moveUp->exeUpdate(
                "adms_grupos_paginas",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dadosGroupPg[0]['id']}"
        );
        if ($moveUp->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Ordem do grupo "
                    . "de páginas alterarda.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Ordem do grupo de páginas
                não foi alterada, tente novamente.</div>";
        return $this->result = false;
    }
}
