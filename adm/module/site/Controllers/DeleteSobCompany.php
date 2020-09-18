<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of DeleteSobCompany
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class DeleteSobCompany
{
    private $dadoId;
    
    public function removeSobCompany($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $deleteSobCompany = new \Module\site\Models\StsDeleteSobCompany();
            $deleteSobCompany->deletarSobCompany($this->dadoId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário "
                    . "selecionar um tópico sobre empresa</div>";
        }
        $UrlDestino = URLADM . 'list-sob-company/list-info-company';
        header("Location: $UrlDestino");
    }
}
