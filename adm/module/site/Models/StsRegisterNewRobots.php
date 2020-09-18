<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsRegisterNewRobots
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsRegisterNewRobots
{
    private $dados;
    private $result;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function viewRobots(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->insertNewRobots();
        }
        return $this->result = false;
    }
    
    private function insertNewRobots()
    {
        $this->dados['created'] = date("Y-m-d H:i:s");
        $addRobots = new \Module\administrative\Models\helper\AdmsCreate();
        $addRobots->exeCreate("sts_robots", $this->dados);
        if ($addRobots->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Robots da "
                    . "página cadastrado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Robots da página "
                . "não cadastrado</div>";
        return $this->result = false;
    }
}
