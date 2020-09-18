<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of DeleteRobots
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class DeleteRobots
{
    private $dadoId;
    
    public function removeRobots($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $deleteRobots = new \Module\site\Models\StsDeleteRobots();
            $deleteRobots->deleteRobots($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário "
                    . "selecionar um robot de páginas</div>";
        }
        $UrlDestino = URLADM . 'list-robots/list-info-robots';
        header("Location: $UrlDestino");
    }
}
