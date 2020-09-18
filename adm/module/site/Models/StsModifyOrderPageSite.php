<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsModifyOrderPageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsModifyOrderPageSite
{
    private $dadoId;
    private $result;
    private $dados;
    private $dadosPage;
    private $dadosPageUnder;
    
    function getResult()
    {
        return $this->result;
    }

    public function alterOrderPageSite($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->viewPageSite($this->dadoId);
        if ($this->dadosPage) {
            $this->pageSiteBottom();
            if ($this->dadosPageUnder) {
                return $this->movePageSite();
            }
            $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi 
                    alterado a ordem da página.</div>";
            return $this->Resultado = false;
        }
    }
    
    private function viewPageSite()
    {
        $viewPage = new \Module\administrative\Models\helper\AdmsRead();
        $viewPage->fullRead(
                "SELECT *
                FROM sts_paginas
                WHERE id =:id
                LIMIT :limit",
                "id=$this->dadoId&limit=1");
        $this->dadosPage = $viewPage->getResult();
    }
    
    private function pageSiteBottom()
    {
        $orderSuper = $this->dadosPage[0]['ordem_paginas'] - 1;
        $viewPage = new \Module\administrative\Models\helper\AdmsRead();
        $viewPage->fullRead(
                "SELECT id, ordem_paginas
                FROM sts_paginas
                WHERE ordem_paginas =:ordem_paginas",
                "ordem_paginas=$orderSuper");
        $this->dadosPageUnder = $viewPage->getResult();
    }
    
    private function movePageSite()
    {
        $this->dados['ordem_paginas'] = $this->dadosPage[0]['ordem_paginas'];
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $moveDown = new \Module\administrative\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate(
                "sts_paginas",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dadosPageUnder[0]['id']}"
        );
        $this->dados['ordem_paginas'] = $this->dadosPage[0]['ordem_paginas'] - 1;
        $moveUp = new \Module\administrative\Models\helper\AdmsUpdate();
        $moveUp->exeUpdate(
                "sts_paginas",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dadosPage[0]['id']}"
        );
        if ($moveUp->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Ordem da "
                    . "página alterarda.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Ordem da "
                . "página não foi alterada, tente novamente.</div>";
        return $this->result = false;
    }
}
