<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsService
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsServiceHome
{
    private $result;
    
    public function listServiceHome()
    {
        $services = new \Sts\Models\helper\StsRead();
        $services->exeRead('sts_servicos', 'LIMIT :limit', 'limit=1');
        $this->result = $services->getResult();
        return $this->result;
    }
}
