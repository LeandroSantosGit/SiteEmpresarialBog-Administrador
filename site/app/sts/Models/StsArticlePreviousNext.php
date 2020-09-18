<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsArticlePreviousNext
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsArticlePreviousNext
{
    private $result;
    private $idArticle;
    
    public function viewArticlePrevious($idAticle = null)
    {
        $this->idArticle = (int) $idAticle;
        $listArticle = new \Sts\Models\helper\StsRead();
        $listArticle->fullRead(
                'SELECT
                    slug
                FROM
                    sts_artigos
                WHERE
                    adms_sit_id =:adms_sit_id
                    AND id <:id
                ORDER BY
                    id DESC
                LIMIT :limit',
                "adms_sit_id=1&id={$this->idArticle}&limit=1");
        $this->result = $listArticle->getResult();
        return $this->result;
    }
    
    public function viewArticleNext($idAticle = null)
    {
        $this->idArticle = (int) $idAticle;
        $listArticle = new \Sts\Models\helper\StsRead();
        $listArticle->fullRead(
                'SELECT
                    slug
                FROM
                    sts_artigos
                WHERE
                    adms_sit_id =:adms_sit_id
                    AND id >:id
                ORDER BY
                    id ASC
                LIMIT :limit',
                "adms_sit_id=1&id={$this->idArticle}&limit=1");
        $this->result = $listArticle->getResult();
        return $this->result;
    }
}
