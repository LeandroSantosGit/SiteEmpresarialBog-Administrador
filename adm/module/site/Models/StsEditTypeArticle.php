<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsEditTypeArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsEditTypeArticle
{
    private $result;
    private $dados;
    private $dadoId;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function viewInfoTypeArticle($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewTpArticle = new \Module\administrative\Models\helper\AdmsRead();
        $viewTpArticle->fullRead(
                "SELECT *
                FROM sts_tps_artigos
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewTpArticle->getResult();
        return $this->result;
    }
    
    public function alterTypeArticle(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->updateTypoArticle();
        }
        return $this->result = false;
    }
    
    private function updateTypoArticle()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateTpArticle = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateTpArticle->exeUpdate(
                "sts_tps_artigos",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dados['id']}"
        );
        if ($updateTpArticle->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Tipo de "
                    . "artigo atualizado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Tipo de "
                    . "artigo não atualizado.</div>";
        return $this->result = false;
    }
}
