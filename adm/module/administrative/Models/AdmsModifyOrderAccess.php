<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsModifyOrderAccess
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsModifyOrderAccess
{
    private $dadoId;
    private $result;
    private $dados;
    private $dadosAccess;
    private $accesPrevious;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function moveOrderAccess($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->orderLevelAccess($this->dadoId);
        if ($this->dadosAccess) {
            $this->levelAccessUnder();
            $this->moveAccess();
        }
    }

    private function orderLevelAccess($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $levelAccess = new \Module\administrative\Models\helper\AdmsRead();
        $levelAccess->fullRead(
                "SELECT *
                FROM adms_niveis_acessos
                WHERE id =:id AND ordem >:ordem
                LIMIT :limit",
                "id=" . $this->dadoId . "&ordem=" . $_SESSION['userOrdemAcesso'] . "&limit=1");
        $this->dadosAccess = $levelAccess->getResult();
    }
    
    private function levelAccessUnder()
    {
        $orderSuper = $this->dadosAccess[0]['ordem'] - 1;
        $viewAccess = new \Module\administrative\Models\helper\AdmsRead();
        $viewAccess->fullRead(
                "SELECT id, ordem
                FROM adms_niveis_acessos
                WHERE ordem =:ordem",
                "ordem={$orderSuper}");
        $this->accesPrevious = $viewAccess->getResult();
    }
    
    private function moveAccess()
    {
        $this->dados['ordem'] = $this->dadosAccess[0]['ordem'];
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $moveDown = new \Module\administrative\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate(
                "adms_niveis_acessos",
                $this->dados,
                "WHERE id =:id",
                "id={$this->accesPrevious[0]['id']}"
        );
        $this->dados['ordem'] = $this->dadosAccess[0]['ordem'] - 1;
        $moveUp = new \Module\administrative\Models\helper\AdmsUpdate();
        $moveUp->exeUpdate(
                "adms_niveis_acessos",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dadosAccess[0]['id']}"
        );
        if ($moveUp->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Ordem do nível de acesso alterarda.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Ordem do nível de 
                acesso não foi alterada, tente novamente.</div>";
        return $this->result = false;
    }
}
