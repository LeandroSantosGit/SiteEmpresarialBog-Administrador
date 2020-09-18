<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsDeleteContact
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsDeleteContact
{
    private $dadoId;
    private $result;
    
    function getResult()
    {
        return $this->result;
    }

    public function deleteMsgContact($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $deleteMsg = new \Module\administrative\Models\helper\AdmsDelete();
        $deleteMsg->executeDelete(
                "sts_contatos",
                "WHERE id =:id",
                "id={$this->dadoId}"
        );
        if ($deleteMsg->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Mensagem"
                    . " de contato apagada.</div>";
                return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Mensagem"
            . " de contato não apagada.</div>";
        return $this->result = false;
    }
}
