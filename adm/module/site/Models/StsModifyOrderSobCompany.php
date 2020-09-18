<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsModifyOrderSobCompany
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsModifyOrderSobCompany
{
    private $dadoId;
    private $result;
    private $dados;
    private $sobCompany;
    private $sobCompanyUnder;
    
    function getResult()
    {
        return $this->result;
    }

    public function alterOrderSobCompany($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->viewInfoSobCompany($this->dadoId);
        if ($this->sobCompany) {
            $this->sobCompanyBottom();
            if ($this->sobCompanyUnder) {
                $this->moveSobCompany();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi 
                        alterado a ordem do tópico sobre empresa.</div>";
                $this->Resultado = false;
            }
        }
    }
    
    private function viewInfoSobCompany()
    {
        $viewInfoCompany = new \Module\administrative\Models\helper\AdmsRead();
        $viewInfoCompany->fullRead(
                "SELECT *
                FROM sts_sob_empresa
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->sobCompany = $viewInfoCompany->getResult();
    }
    
    private function sobCompanyBottom()
    {
        $orderSuper = $this->sobCompany[0]['ordem'] - 1;
        $viewInfoCompany = new \Module\administrative\Models\helper\AdmsRead();
        $viewInfoCompany->fullRead(
                "SELECT id, ordem
                FROM sts_sob_empresa
                WHERE ordem =:ordem",
                "ordem={$orderSuper}");
        $this->sobCompanyUnder = $viewInfoCompany->getResult();
    }
    
    private function moveSobCompany()
    {
        $this->dados['ordem'] = $this->sobCompany[0]['ordem'];
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $moveDown = new \Module\administrative\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate(
                "sts_sob_empresa",
                $this->dados,
                "WHERE id =:id",
                "id={$this->sobCompanyUnder[0]['id']}"
        );
        $this->dados['ordem'] = $this->sobCompany[0]['ordem'] - 1;
        $moveUp = new \Module\administrative\Models\helper\AdmsUpdate();
        $moveUp->exeUpdate(
                "sts_sob_empresa",
                $this->dados,
                "WHERE id =:id",
                "id={$this->sobCompany[0]['id']}"
        );
        if ($moveUp->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Ordem do tópico "
                    . "sobre empresa alterarda.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Ordem do tópico "
                . "sobre empresa não foi alterada, tente novamente.</div>";
        return $this->result = false;
    }
}
