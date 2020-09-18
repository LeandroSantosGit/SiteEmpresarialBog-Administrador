<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of DeleteSituationPage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class DeleteSituationPage
{
    private $dadoId;
    
    public function removeSituationPage($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $delete = new \Module\administrative\Models\AdmsDeleteSituationPage();
            $delete->deleteSituationPage($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Selecione "
                    . "uma situação de página.</div>";
        }
        $urlRedirect = URLADM . 'list-situation-page/list-situation-pages';
        header("Location: $urlRedirect");
    }
}
