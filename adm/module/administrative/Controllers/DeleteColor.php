<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location; /");
    exit();
}

/**
 * Description of DeleteColor
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class DeleteColor
{
    private $dadoId;
    
    public function removeColor($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $delete = new \Module\administrative\Models\AdmsDeleteColor();
            $delete->deleteColor($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Selecione uma cor.</div>";
        }
        $urlRedirect = URLADM . 'list-color/list-colors';
        header("Location: $urlRedirect");
    }
}
