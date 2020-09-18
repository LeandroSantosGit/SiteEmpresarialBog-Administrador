<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ModifyOrderTypePage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ModifyOrderTypePage
{
    private $dadoId;
    
    public function alterOrderTypePage($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $orderGroupPg = new \Module\administrative\Models\AdmsModifyOrderTypePage();
            $orderGroupPg->moveOrderTypePage($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário 
                    selecionar um tipo de páginas</div>";
        }
        $urlRedirect = URLADM . 'list-type-page/list-types-pages';
        return header("Location: $urlRedirect");
    }
}
