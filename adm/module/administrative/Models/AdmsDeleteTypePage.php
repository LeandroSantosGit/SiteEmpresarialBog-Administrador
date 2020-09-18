<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsDeleteTypePage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsDeleteTypePage
{
    private $dadoId;
    private $result;
    private $dados;
    private $dadoUnder;
    
    function getResult()
    {
        return $this->result;
    }

    public function deleteTypePage($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->checkRegisterTypePage();
        if ($this->result) {
            $this->checkBottomTypePage();
            $delete = new \Module\administrative\Models\helper\AdmsDelete();
            $delete->executeDelete("adms_tipos_paginas", "WHERE id =:id", "id={$this->dadoId}");
            if ($delete->getResult()) {
                $this->moveOrder();
                $_SESSION['msg'] = "<div class='alert alert-success'>Tipo de páginas apagado.</div>";
                return $this->result = true;
            }
            $_SESSION['msg'] = "<div class='alert alert-danger'>Tipo de páginas não apagado.</div>";
            return $this->result = false;
        }
    }
    
    private function checkRegisterTypePage()
    {
        $checkPage = new \Module\administrative\Models\helper\AdmsRead();
        $checkPage->fullRead(
                "SELECT id
                FROM adms_paginas
                WHERE adms_tipos_pagina_id =:adms_tipos_pagina_id
                LIMIT :limit",
                "adms_tipos_pagina_id={$this->dadoId}&limit=2");
        if ($checkPage->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Tipo de páginas não
                    pode ser apagado, há páginas cadastradas neste tipo.</div>";
            return $this->result = false;
        }
        return $this->result = true;
    }
    
    private function checkBottomTypePage()
    {
        $groupPg = new \Module\administrative\Models\helper\AdmsRead();
        $groupPg->fullRead(
                "SELECT id, ordem ordemResult
                FROM adms_tipos_paginas
                WHERE ordem > (
                        SELECT ordem
                        FROM adms_tipos_paginas
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
                        "adms_tipos_paginas",
                        $this->dados,
                        "WHERE id =:id", "id=" . $id
                );
            }
        }
    }
}
