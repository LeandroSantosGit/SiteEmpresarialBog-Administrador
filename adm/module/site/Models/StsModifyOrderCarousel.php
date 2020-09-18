<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsModifyOrderCarousel
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsModifyOrderCarousel
{
    private $dadoId;
    private $result;
    private $dados;
    private $dadosCarousel;
    private $dadosCarouselUnder;
    
    function getResult()
    {
        return $this->result;
    }

    public function moveOrderCarousel($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->viewInfoCarousel($this->dadoId);
        if ($this->dadosCarousel) {
            $this->carouselBottom();
            if ($this->dadosCarouselUnder) {
                return $this->moveCarousel();
            }
            $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi 
                    alterado a ordem do grupo de páginas</div>";
            return $this->Resultado = false;
        }
    }
    
    private function viewInfoCarousel()
    {
        $viewCarousel = new \Module\administrative\Models\helper\AdmsRead();
        $viewCarousel->fullRead(
                "SELECT *
                FROM sts_carousels
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->dadosCarousel = $viewCarousel->getResult();
    }
    
    private function carouselBottom()
    {
        $orderSuper = $this->dadosCarousel[0]['ordem'] - 1;
        $viewCarousel = new \Module\administrative\Models\helper\AdmsRead();
        $viewCarousel->fullRead(
                "SELECT id, ordem
                FROM sts_carousels
                WHERE ordem =:ordem",
                "ordem={$orderSuper}");
        $this->dadosCarouselUnder = $viewCarousel->getResult();
    }
    
    private function moveCarousel()
    {
        $this->dados['ordem'] = $this->dadosCarousel[0]['ordem'];
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $moveDown = new \Module\administrative\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate(
                "sts_carousels",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dadosCarouselUnder[0]['id']}"
        );
        $this->dados['ordem'] = $this->dadosCarousel[0]['ordem'] - 1;
        $moveUp = new \Module\administrative\Models\helper\AdmsUpdate();
        $moveUp->exeUpdate(
                "sts_carousels",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dadosCarousel[0]['id']}"
        );
        if ($moveUp->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Ordem de slide "
                    . "do carousel alterarda.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Ordem de slide "
                . "grupo do carousel não foi alterada, tente novamente.</div>";
        return $this->result = false;
    }
}
