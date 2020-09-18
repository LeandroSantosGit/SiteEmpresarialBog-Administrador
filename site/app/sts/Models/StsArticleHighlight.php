<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsArticlehighlight
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsArticleHighlight
{
    private $result;
    
    public function listArticleHighlight()
    {
        $listHighlight = new \Sts\Models\helper\StsRead();
        $listHighlight->fullRead(
                'SELECT
                    titulo,
                    slug
                FROM
                    sts_artigos
                WHERE
                    adms_sit_id =:adms_sit_id
                ORDER BY
                    qnt_acesso DESC
                LIMIT :limit', 
                "adms_sit_id=1&limit=7");
        $this->result = $listHighlight->getResult();
        return $this->result;
    }
}
