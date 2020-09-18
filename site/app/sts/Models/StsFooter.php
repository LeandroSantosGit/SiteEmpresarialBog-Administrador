<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsFooter
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsFooter
{
    private $result;
    
    public function listFooter()
    {
        $list = new \Sts\Models\helper\StsRead();
        $list->fullRead(
                "SELECT
                    nome_empresa,
                    copyright,
                    email,
                    telefone1,
                    telefone2,
                    facebook_url,
                    twitter_url,
                    instagram_url,
                    whatsapp_url,
                    rua,
                    bairro,
                    cidade,
                    numero,
                    cep,
                    uf
                FROM
                    sts_footer
                WHERE
                    sts_tipos_paginas_id =:sts_tipos_paginas_id
                LIMIT :limit",
                "sts_tipos_paginas_id=1&limit=1");
        $this->result = $list->getResult();
        return $this->result;
    }
}
