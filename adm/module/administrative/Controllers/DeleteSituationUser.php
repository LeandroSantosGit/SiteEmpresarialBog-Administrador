<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of DeleteSituationUser
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class DeleteSituationUser
{
    private $dadoId;
    
    public function removeSituationUser($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $delete = new \Module\administrative\Models\AdmsDeleteSituationUser();
            $delete->deleteSituationUser($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Selecione uma "
                    . "situação usuário.</div>";
        }
        $urlRedirect = URLADM . 'list-situation-user/list-situation-users';
        header("Location: $urlRedirect");
    }
}
