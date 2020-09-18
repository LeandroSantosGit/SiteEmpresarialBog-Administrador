<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsDeleteColor
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsDeleteColor
{
    private $dadoId;
    private $result;
    
    function getResult()
    {
        return $this->result;
    }

    public function deleteColor($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $delete = new \Module\administrative\Models\helper\AdmsDelete();
        $delete->executeDelete("adms_cors", "WHERE id =:id", "id={$this->dadoId}");
        if ($delete->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Cor apagada 
                    com sucesso.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Cor não foi apagada,
                 tente novamente</div>";
        return $this->result = false;
    }
}
