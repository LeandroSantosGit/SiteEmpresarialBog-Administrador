<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsDeleteTypeArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsDeleteTypeArticle
{
    private $dadoId;
    private $result;
    
    function getResult()
    {
        return $this->result;
    }

    public function deleteTypeArticle($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->checkRegisterTypeArticle();
        if ($this->result) {
            $deleteTpArticle = new \Module\administrative\Models\helper\AdmsDelete();
            $deleteTpArticle->executeDelete(
                    "sts_tps_artigos",
                    "WHERE id =:id",
                    "id={$this->dadoId}"
            );
            if ($deleteTpArticle->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Tipo de "
                        . "artigo apagado.</div>";
                return $this->result = true;
            }
            $_SESSION['msg'] = "<div class='alert alert-danger'>Tipo de "
                    . "artigo não apagado.</div>";
            return $this->result = false;
        }
    }
    
    private function checkRegisterTypeArticle()
    {
        $viewTpArticle = new \Module\administrative\Models\helper\AdmsRead();
        $viewTpArticle->fullRead(
                "SELECT id
                FROM sts_artigos
                WHERE sts_tps_artigo_id =:sts_tps_artigo_id
                LIMIT :limit",
                "sts_tps_artigo_id={$this->dadoId}&limit=2");
        if ($viewTpArticle->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Tipo de "
                    . "artigo não pode ser apagado, há artigo cadastrado neste tipo.</div>";
            return $this->result = false;
        }
        return $this->result = true;
    }
}
