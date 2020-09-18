<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of DeleteMenu
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class DeleteMenu
{
    private $dadoId;
    
    public function removeMenu($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $delete = new \Module\administrative\Models\AdmsDeleteMenu();
            $delete->deleteItemMenu($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Selecione um item do menu.</div>";
        }
        $urlRedirect = URLADM . 'list-menu/list-itens-menu';
        header("Location: $urlRedirect");
    }
}
