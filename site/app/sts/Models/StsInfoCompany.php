<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsSobEmpresa
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsInfoCompany
{
    private $result;
    
    public function listInfCompany()
    {
        $company = new \Sts\Models\helper\StsRead();
        $company->fullRead(
                'SELECT
                    id,
                    titulo,
                    descricao,
                    imagem
                FROM
                    sts_sob_empresa
                WHERE 
                    adms_sit_id =:adms_sit_id
                ORDER BY
                    ordem ASC',
                    'adms_sit_id=1');
        $this->result = $company->getResult();
        return $this->result;
    }
}
