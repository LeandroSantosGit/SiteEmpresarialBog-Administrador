<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of DeleteLevelAccess
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class DeleteLevelAccess
{
    private $dadoId;
    
    public function removeAcess($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $deleteAcc = new \Module\administrative\Models\AdmsDeleteLevelAccess();
            $deleteAcc->deleteAccess($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-primary'>Necessário
                    selecionar nívelde acesso.</div>";
        }
        $urlRedirect = URLADM . 'access-level/list-access';
        header("Location: $urlRedirect");
    }
}
