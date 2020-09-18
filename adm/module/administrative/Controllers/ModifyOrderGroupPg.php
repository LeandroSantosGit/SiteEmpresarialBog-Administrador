<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ModifyOrderGroupPg
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ModifyOrderGroupPg
{
    private $dadoId;
    
    public function alterOrderGroupPg($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $orderGroupPg = new \Module\administrative\Models\AdmsModifyOrderGroupPg();
            $orderGroupPg->moveOrderGroupPage($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário 
                    selecionar um grupo de páginas</div>";
        }
        $urlRedirect = URLADM . 'list-group-page/list-groups-pages';
        return header("Location: $urlRedirect");
    }
}
