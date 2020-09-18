<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ModifyOrderItemMenu
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ModifyOrderItemMenu
{
    private $dadoId;
    
    public function alterOrderItemMenu($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $orderItemMenu = new \Module\administrative\Models\AdmsModifyOrderItemMenu();
            $orderItemMenu->moveOrderItemMenu($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário 
                    selecionar um item do menu</div>";
        }
        $urlRedirect = URLADM . 'list-menu/list-itens-menu';
        return header("Location: $urlRedirect");
    }
}
