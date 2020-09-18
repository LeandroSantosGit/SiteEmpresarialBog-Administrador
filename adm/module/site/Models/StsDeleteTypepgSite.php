<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsDeleteTypepgSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsDeleteTypepgSite
{
    private $dadoId;
    private $dados;
    private $typePageUnder;
    private $result;
    
    function getResult()
    {
        return $this->result;
    }

    public function deleteTypePageSite($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->checkRegisterPages();
        if ($this->result) {
            $this->checkBottomTypePage();
            $deleteTypePg = new \Module\administrative\Models\helper\AdmsDelete();
            $deleteTypePg->executeDelete(
                    "sts_tipos_paginas",
                    "WHERE id =:id",
                    "id={$this->dadoId}"
            );
            if ($deleteTypePg->getResult()) {
                $this->moveOrder();
                $_SESSION['msg'] = "<div class='alert alert-success'>Tipo de "
                        . "página apagado.</div>";
                return $this->result = true;
            }
            $_SESSION['msg'] = "<div class='alert alert-danger'>Tipo de "
                        . "página não apagado.</div>";
            return $this->result = false;
        }
    }
    
    private function checkRegisterPages()
    {
        $viewPage = new \Module\administrative\Models\helper\AdmsRead();
        $viewPage->fullRead(
                "SELECT id
                FROM sts_paginas
                WHERE sts_tipos_pagina_id =:sts_tipos_pagina_id
                LIMIT :limit",
                "sts_tipos_pagina_id={$this->dadoId}&limit=2");
        if ($viewPage->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Tipo de página"
                    . " não pode ser apagado, há páginas cadastradas neste tipo de página.</div>";
                return $this->result = false;
            }
            return $this->result = true;
    }
    
    private function checkBottomTypePage()
    {
        $viewTypePg = new \Module\administrative\Models\helper\AdmsRead();
        $viewTypePg->fullRead(
                "SELECT id, ordem ordemResult
                FROM sts_tipos_paginas
                WHERE ordem > (
                        SELECT ordem
                        FROM sts_tipos_paginas
                        WHERE id =:id)
                ORDER BY ordem ASC",
                "id=$this->dadoId");
        $this->typePageUnder = $viewTypePg->getResult();
    }
    
    private function moveOrder()
    {
        if ($this->typePageUnder) {
            foreach ($this->typePageUnder as $actualOrder) {
                extract($actualOrder);
                $this->dados['ordem'] = $ordemResult - 1;
                $this->dados['modified'] = date("Y-m-d H:i:s");
                $updateCarousel = new \Module\administrative\Models\helper\AdmsUpdate();
                $updateCarousel->exeUpdate(
                        "sts_tipos_paginas",
                        $this->dados,
                        "WHERE id =:id",
                        "id=" . $id
                );
            }
        }
    }
}
