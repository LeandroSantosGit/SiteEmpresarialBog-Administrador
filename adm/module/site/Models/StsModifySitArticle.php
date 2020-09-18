<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsModifySitArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsModifySitArticle
{
    private $dadoId;
    private $result;
    private $dados;
    private $dadoArticle;
    
    function getResult()
    {
        return $this->result;
    }

    public function alterSituationArticle($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->viewInfoArticle();
        if ($this->dadoArticle) {
            return $this->updateArticle();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi 
                alterado a situação do artigo.</div>";
        return $this->Resultado = false;
    }
    
    private function viewInfoArticle()
    {
        $viewArticle = new \Module\administrative\Models\helper\AdmsRead();
        $viewArticle->fullRead(
                "SELECT id, adms_sit_id
                FROM sts_artigos
                WHERE id =:id",
                "id={$this->dadoId}");
        $this->dadoArticle = $viewArticle->getResult();
    }
    
    private function updateArticle()
    {
        if ($this->dadoArticle['0']['adms_sit_id'] == 1) {
            $this->dados['adms_sit_id'] = 2;
        } else {
            $this->dados['adms_sit_id'] = 1;
        }
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateArticle = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateArticle->exeUpdate(
                "sts_artigos",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dadoId}"
        );
        if ($updateArticle->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação "
                    . "do artigo alterarda.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Situação "
                . " do artigo não foi alterada, tente novamente.</div>";
        return $this->result = false;
    }
}
