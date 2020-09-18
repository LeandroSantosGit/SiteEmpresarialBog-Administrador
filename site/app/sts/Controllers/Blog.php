<?php

namespace App\sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Blog
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class Blog
{
    private $dados;
    private $pageId;
    
    public function index()
    {
        $this->menu();
        $this->seo();
        $this->articlePagination();
        $this->recentArticle();
        $this->highlightArticle();
        $this->infoAuthorArticle();
        $this->footer();
        
        $loadView = new \Core\ConfigView('sts/Views/blog/blog', $this->dados);
        $loadView->renderView();
    }
    
    private function menu()
    {
        $listMenu = new \Sts\Models\StsMenu();
        $this->dados['menu'] = $listMenu->listMenu();
    }
    
    private function seo()
    {
        $listSeo = new \Sts\Models\StsSeo();
        $this->dados['seo'] = $listSeo->listSeo();
    }
    
    private function articlePagination()
    {
        $this->pageId = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
        $this->pageId = $this->pageId ? $this->pageId : 1;
        $listArticle = new \Sts\Models\StsBlog();
        $this->dados['artigos'] = $listArticle->listArticleBlog($this->pageId);
        $this->dados['paginacao'] = $listArticle->getResultPage();
    }
    
    private function recentArticle()
    {
        $listArticleRecent = new \Sts\Models\StsArticleRecent();
        $this->dados['artigosRecentes'] = $listArticleRecent->listArticleRecent();
    }

    private function highlightArticle()
    {
        $listArticleHighlight = new \Sts\Models\StsArticleHighlight();
        $this->dados['artigosDestaque'] = $listArticleHighlight->listArticleHighlight();
    }

    private function infoAuthorArticle()
    {
        $listInfoAuthor = new \Sts\Models\StsInfoAuthor();
        $this->dados['informacaoAutor'] = $listInfoAuthor->infoAuthor();
    }
    
    private function footer()
    {
        $listFooter = new \Sts\Models\StsFooter();
        $this->dados['stsFooter'] = $listFooter->listFooter();
    }
}
