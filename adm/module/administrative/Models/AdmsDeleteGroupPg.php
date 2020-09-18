<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsDeleteGroupPg
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsDeleteGroupPg
{
    private $dadoId;
    private $result;
    private $dados;
    private $dadoUnder;
    
    function getResult()
    {
        return $this->result;
    }

    public function deleteGroupPage($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->checkRegisterGroupPage();
        if ($this->result) {
            $this->checkBottomGroupPage();
            $delete = new \Module\administrative\Models\helper\AdmsDelete();
            $delete->executeDelete("adms_grupos_paginas", "WHERE id =:id", "id={$this->dadoId}");
            if ($delete->getResult()) {
                $this->moveOrder();
                $_SESSION['msg'] = "<div class='alert alert-success'>Grupo de páginas apagado.</div>";
                return $this->result = true;
            }
            $_SESSION['msg'] = "<div class='alert alert-danger'>Grupo de páginas não apagado.</div>";
            return $this->result = false;
        }
    }
    
    private function checkRegisterGroupPage()
    {
        $checkPage = new \Module\administrative\Models\helper\AdmsRead();
        $checkPage->fullRead(
                "SELECT id
                FROM adms_paginas
                WHERE adms_grupo_pagina_id =:adms_grupo_pagina_id
                LIMIT :limit",
                "adms_grupo_pagina_id={$this->dadoId}&limit=2");
        if ($checkPage->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Grupo de páginas não
                    pode ser apagado, há páginas cadastradas neste grupo.</div>";
            return $this->result = false;
        }
        return $this->result = true;
    }
    
    private function checkBottomGroupPage()
    {
        $groupPg = new \Module\administrative\Models\helper\AdmsRead();
        $groupPg->fullRead(
                "SELECT id, ordem ordemResult
                FROM adms_grupos_paginas
                WHERE ordem > (
                        SELECT ordem
                        FROM adms_grupos_paginas
                        WHERE id =:id)
                ORDER BY ordem ASC",
                "id={$this->dadoId}");
        $this->dadoUnder = $groupPg->getResult();
    }
    
    private function moveOrder()
    {
        if ($this->dadoUnder) {
            foreach ($this->dadoUnder as $currentOrder) {
                extract($currentOrder);
                $this->dados['ordem'] = $ordemResult - 1;
                $this->dados['modified'] = date("Y-m-d H:i");
                $updateAccess = new \Module\administrative\Models\helper\AdmsUpdate();
                $updateAccess->exeUpdate(
                        "adms_grupos_paginas",
                        $this->dados,
                        "WHERE id =:id", "id=" . $id
                );
            }
        }
    }
}
