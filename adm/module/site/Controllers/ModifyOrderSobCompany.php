<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ModifyOrderSobCompany
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ModifyOrderSobCompany
{
    private $dadoId;
    
    public function alterOrderSobCompany($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $ordemSobCompany = new \Module\site\Models\StsModifyOrderSobCompany();
            $ordemSobCompany->alterOrderSobCompany($this->dadoId);
        }else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário 
                    selecionar um tópico sobre empresa</div>";
        }
        $urlRedirect = URLADM . 'list-sob-company/list-info-company';
        return header("Location: $urlRedirect");
    }
}
