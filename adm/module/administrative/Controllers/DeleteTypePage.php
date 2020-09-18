<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of DeleteTypePage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class DeleteTypePage
{
    private $dadoId;
    
    public function removeTypePage($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $delete = new \Module\administrative\Models\AdmsDeleteTypePage();
            $delete->deleteTypePage($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Selecione um"
                    . " tipo de páginas.</div>";
        }
        $urlRedirect = URLADM . 'list-type-page/list-types-pages';
        header("Location: $urlRedirect");
    }
}
