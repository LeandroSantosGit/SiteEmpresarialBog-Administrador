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
class StsArticle
{
    private $result;
    private $article;
    
    public function toViewArticle($article = null)
    {
        $this->article = (string) $article;
        $viewArt = new \Sts\Models\helper\StsRead();
        $viewArt->fullRead(
                'SELECT
                    id,
                    titulo,
                    conteudo,
                    imagem,
                    slug
                FROM
                    sts_artigos
                WHERE
                    adms_sit_id =:adms_sit_id
                    AND slug =:slug
                ORDER BY
                    id DESC
                LIMIT :limit',
                "adms_sit_id=1&slug={$this->article}&limit=1");
        $this->result = $viewArt->getResult();
        return $this->result;
    }
}
