<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsEditColor
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsEditColor
{
    private $result;
    private $dados;
    private $dadoId;
    
    function getResult()
    {
        return $this->result;
    }

    public function viewInfoColor($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewCor = new \Module\administrative\Models\helper\AdmsRead();
        $viewCor->fullRead(
                "SELECT *
                FROM adms_cors
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewCor->getResult();
        return $this->result;
    }
    
    public function alterColor(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->updateEditColor();
        }
        return $this->result = false;
    }
    
    private function updateEditColor()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateColor = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateColor->exeUpdate(
                "adms_cors",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dados['id']}"
        );
        if ($updateColor->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Cor atualizado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Cor não 
                atualizada, tente novamente.</div>";
        return $this->result = false;
    }
}
