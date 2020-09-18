<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsArticleRecent
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsArticleRecent
{
    private $result;
    
    public function listArticleRecent()
    {
        $listArticle = new \Sts\Models\helper\StsRead();
        $listArticle->fullRead(
                'SELECT
                    titulo,
                    slug
                FROM
                    sts_artigos
                WHERE
                    adms_sit_id =:adms_sit_id
                ORDER BY
                    id DESC
                LIMIT :limit',
                "adms_sit_id=1&limit=7");
        $this->result = $listArticle->getResult();
        return $this->result;
    }
}
