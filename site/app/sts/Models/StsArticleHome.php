<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsArticleHome
{
    private $result;
    
    public function listArticliHome()
    {
        $article = new \Sts\Models\helper\StsRead();
        $article->fullRead(
                'SELECT
                    id,
                    titulo,
                    descricao,
                    imagem,
                    slug
                FROM
                    sts_artigos 
                WHERE
                    adms_sit_id =:adms_sit_id
                ORDER BY
                    id DESC
                LIMIT :limit',
                    'adms_sit_id=1&limit=3');
        $this->result = $article->getResult();
        return $this->result;
    }
}
