<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsInfoAuthor
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsInfoAuthor
{
    private $result;
    
    public function infoAuthor()
    {
        $aboutAuthor = new \Sts\Models\helper\StsRead();
        $aboutAuthor->fullRead(
                'SELECT
                    id,
                    titulo,
                    descricao,
                    imagem
                FROM
                    sts_sobres
                WHERE
                    adms_sit_id =:adms_sit_id
                    AND id =:id
                LIMIT :limit',
                "adms_sit_id=1&id=1&limit=1");
        $this->result = $aboutAuthor->getResult();
        return $this->result;
    }
}
