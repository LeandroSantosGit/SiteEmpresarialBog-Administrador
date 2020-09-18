<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsEditService
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsEditService
{
    private $result;
    private $dados;
    
    function getResult()
    {
        return $this->result;
    }

    public function viewInfoServices()
    {
        $viewServices = new \Module\administrative\Models\helper\AdmsRead();
        $viewServices->fullRead(
                "SELECT *
                FROM sts_servicos
                WHERE id =:id
                LIMIT :limit",
                "id=1&limit=1");
        $this->result = $viewServices->getResult();
        return $this->result;
    }
    
    public function alterServices(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->updateEditServices();
        }
        return $this->result = false;
    }
    
    private function updateEditServices()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateService = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateService->exeUpdate(
                "sts_servicos",
                $this->dados,
                "WHERE id =:id",
                "id=1"
        );
        if ($updateService->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Serviços do "
                    . "site atualizado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Servicços do "
                . "site não atualizada, tente novamente.</div>";
        return $this->result = false;
    }
}
