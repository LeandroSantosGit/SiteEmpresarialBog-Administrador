<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ModifyOrderAccess
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ModifyOrderAccess
{
    private $dadoId;
    
    public function modifyOrderAcc($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $orderAccess = new \Module\administrative\Models\AdmsModifyOrderAccess;
            $orderAccess->moveOrderAccess($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário 
                    selecionar um nível de acesso</div>";
        }
        $urlRedirect = URLADM . 'access-level/list-access';
        header("Location: $urlRedirect");
    }
}
