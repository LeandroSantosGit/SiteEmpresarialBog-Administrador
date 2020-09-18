<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsDeletePageSite
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsDeletePageSite
{
    private $dadoId;
    private $result;
    private $pageSite;
    private $pageSiteUnder;
    
    function getResult()
    {
        return $this->result;
    }

    public function deletePageSite($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->viewPageSite();
        if ($this->pageSite) {
            $this->checkBottomPageSite();
            $delete = new \Module\administrative\Models\helper\AdmsDelete();
            $delete->executeDelete(
                    "sts_paginas",
                    "WHERE id =:id",
                    "id={$this->dadoId}"
            );
            if ($delete->getResult()) {
                $this->moveOrder();
                $this->deleteImgPageSite();
                $_SESSION['msg'] = "<div class='alert alert-success'>Página do"
                        . " site apagado.</div>";
                return $this->result = true;
            }
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Página do"
                        . " site não apagado.</div>";
       return $this->result = false;
    }
    
    private function deleteImgPageSite()
    {
        $deleteImg = new \Module\administrative\Models\helper\AdmsDeleteImg();
        $deleteImg->deleteImage(
                '../site/assets/images/page/'
                    . $this->dadoId
                    . '/'
                    . $this->pageSite[0]['imagem'],
                '../site/assets/images/page/' . $this->dadoId
        );
    }
    
    private function viewPageSite()
    {
        $viewPage = new \Module\administrative\Models\helper\AdmsRead();
        $viewPage->fullRead(
                "SELECT imagem
                FROM sts_paginas
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->pageSite = $viewPage->getResult();
    }
    
    private function checkBottomPageSite()
    {
        $viewPage = new \Module\administrative\Models\helper\AdmsRead();
        $viewPage->fullRead(
                "SELECT id, ordem_paginas ordemResult
                FROM sts_paginas
                WHERE ordem_paginas >(
                        SELECT ordem_paginas
                        FROM sts_paginas
                        WHERE id =:id)
                ORDER BY ordem_paginas ASC",
                "id={$this->dadoId}");
        $this->pageSiteUnder = $viewPage->getResult();
    }
    
    private function moveOrder()
    {
        if ($this->pageSiteUnder) {
            foreach ($this->pageSiteUnder as $actualOrder) {
                extract($actualOrder);
                $this->dados['ordem_paginas'] = $ordemResult - 1;
                $this->dados['modified'] = date("Y-m-d H:i:s");
                $updateCarousel = new \Module\administrative\Models\helper\AdmsUpdate();
                $updateCarousel->exeUpdate(
                        "sts_paginas",
                        $this->dados,
                        "WHERE id =:id",
                        "id=" . $id
                );
            }
        }
    }
}
