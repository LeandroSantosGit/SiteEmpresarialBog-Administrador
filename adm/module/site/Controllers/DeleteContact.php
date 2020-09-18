<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of DeleteContact
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class DeleteContact
{
    private $dadoId;
    
    public function removeContact($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $deleteMsg = new \Module\site\Models\StsDeleteContact();
            $deleteMsg->deleteMsgContact($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário "
                    . "selecionar uma mensagem de contato</div>";
        }
        $UrlDestino = URLADM . 'list-contact/list-info-contact';
        header("Location: $UrlDestino");
    }
}
