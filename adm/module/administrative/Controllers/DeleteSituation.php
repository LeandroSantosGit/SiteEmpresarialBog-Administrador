<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of DeleteSituation
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class DeleteSituation
{
    private $dadoId;
    
    public function removeSituation($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $delete = new \Module\administrative\Models\AdmsDeleteSituation();
            $delete->deleteSituation($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Selecione uma situação.</div>";
        }
        $urlRedirect = URLADM . 'list-situation/list-situations';
        header("Location: $urlRedirect");
    }
}
