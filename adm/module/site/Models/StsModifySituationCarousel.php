<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsModifySituationCarousel
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsModifySituationCarousel
{
    private $dados;
    private $result;
    private $dadoId;
    private $dadosCarousel;
    
    function getResult()
    {
        return $this->result;
    }

    public function alterSituationCarousel($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->viewInfoCarousel();
        if ($this->dadosCarousel) {
            return $this->updateCarousel();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi 
                alterado a situação do slide do carousel</div>";
        return $this->Resultado = false;
    }
    
    private function viewInfoCarousel()
    {
        $viewCarousel = new \Module\administrative\Models\helper\AdmsRead();
        $viewCarousel->fullRead(
                "SELECT id, adms_situacoes_id
                FROM sts_carousels
                WHERE id =:id",
                "id={$this->dadoId}");
        $this->dadosCarousel = $viewCarousel->getResult();
    }
    
    private function updateCarousel()
    {
        if ($this->dadosCarousel[0]['adms_situacoes_id'] == 1) {
            $this->dados['adms_situacoes_id'] = 2;
        } else {
            $this->dados['adms_situacoes_id'] = 1;
        }
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateCarousel = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateCarousel->exeUpdate(
                "sts_carousels",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dadoId}"
        );
        if ($updateCarousel->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação de slide "
                    . "do carousel alterarda.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Situação de slide "
                . " do carousel não foi alterada, tente novamente.</div>";
        return $this->result = false;
    }
}
