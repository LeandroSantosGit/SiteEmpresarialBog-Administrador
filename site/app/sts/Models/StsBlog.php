<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsBlog
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsBlog
{
    private $result;
    private $pageId;
    private $resultPage;
    private $limitResultArticle = 3;
    
    function getResultPage()
    {
        return $this->resultPage;
    }
    
    public function listArticleBlog($pageId = null)
    {
        $this->pageId = (int) $pageId;
        $pagination = new \Sts\Models\helper\StsPagination(URL . 'blog');
        $pagination->requirementPage($this->pageId, $this->limitResultArticle);
        $pagination->paginationPage(
                'SELECT
                    COUNT(id) AS num_result
                FROM 
                    sts_artigos
                WHERE
                    adms_sit_id =:adms_sit_id',
                    'adms_sit_id=1');
        $this->resultPage = $pagination->getResultPagination();
            
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
                LIMIT :limit
                OFFSET :offset',
                "adms_sit_id=1&limit={$this->limitResultArticle}&offset={$pagination->getOffset()}");
        $this->result = $article->getResult();
        return $this->result;
    }
}
