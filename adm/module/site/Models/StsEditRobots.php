<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsEditRobots
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsEditRobots
{
    private $result;
    private $dadoId;
    private $dados;
    
    function getResult()
    {
        return $this->result;
    }

    public function viewRobots($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewRobots = new \Module\administrative\Models\helper\AdmsRead();
        $viewRobots->fullRead(
                "SELECT *
                FROM sts_robots
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewRobots->getResult();
        return $this->result;
    }
    
    public function alterRobots(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->updateEditRobots();
        }
        return $this->result = false;
    }
    
    private function updateEditRobots()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateRobots = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateRobots->exeUpdate(
                "sts_robots",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dados['id']}"
        );
        if ($updateRobots->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Robots atualizado</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Robots não atualizado</div>";
        return $this->result = false;
    }
}
