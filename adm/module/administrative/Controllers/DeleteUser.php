<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of DeleteUser
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class DeleteUser
{
    private $dadoId;
    
    public function removeUser($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $deleteUser = new \Module\administrative\Models\AdmsDeleteUser();
            $deleteUser->removeuser($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Selecione um usuário</div>";
        }
        $urlRedirect = URLADM . 'users/list-users';
        header("Location: $urlRedirect");
    }
}
