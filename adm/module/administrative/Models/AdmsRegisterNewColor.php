<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsRegisterNewColor
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsRegisterNewColor
{
    private $dados;
    private $result;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function registerColor(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->insertColor();
        }
        return $this->result = false;
    }
    
    private function insertColor()
    {
        $this->dados['created'] = date("Y-m-d H:i:s");
        $addColor = new \Module\administrative\Models\helper\AdmsCreate();
        $addColor->exeCreate("adms_cors", $this->dados);
        if ($addColor->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Cor cadastrada.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Cor não 
                cadastrada, tente novamente.</div>";
        return $this->result = false;
    }
}
