<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of DeleteGroupPg
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class DeleteGroupPg
{
    private $dadoId;
    
    public function removeGroupPg($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $delete = new \Module\administrative\Models\AdmsDeleteGroupPg();
            $delete->deleteGroupPage($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário "
                    . "selecionar um grupo de página</div>";
        }
        $UrlDestino = URLADM . 'list-group-page/list-groups-pages';
        header("Location: $UrlDestino");
    }
}
