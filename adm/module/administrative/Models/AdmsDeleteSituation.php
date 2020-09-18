<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsDeleteSituation
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsDeleteSituation
{
    private $dadoId;
    private $result;
    
    function getResult()
    {
        return $this->result;
    }

    public function deleteSituation($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $delete = new \Module\administrative\Models\helper\AdmsDelete();
        $delete->executeDelete("adms_situacao", "WHERE id =:id", "id={$this->dadoId}");
        if ($delete->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação apagada 
                    com sucesso.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Situação não foi apagada,
                 tente novamente</div>";
        return $this->result = false;
    }
}
