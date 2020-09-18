<?php

namespace App\sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Artigo
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class Artigo
{
    private $dados;
    private $article;
    private $ListSeo;

    public function index($article = null)
    {
        $this->article = (string) $article;
        $viewArticle = new \Sts\Models\StsArticle();
        $this->dados['visualizarArtigo'] = $viewArticle->toViewArticle($this->article);
        $this->menu();
        $this->seo();
        $this->recentArticle();
        $this->highlightArticle();
        $this->infoAuthorArticle();
        $this->previuosNextArticle();
        $this->footer();
        
        $loadView = new \Core\ConfigView('sts/Views/blog/article', $this->dados);
        $loadView->renderView();
    }
    
    private function menu()
    {
        $listMenu = new \Sts\Models\StsMenu();
        $this->dados['menu'] = $listMenu->listMenu();
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

    private function seo()
    {
        $this->ListSeo = new \Sts\Models\StsSeo();
        $this->dados['seo'] = $this->ListSeo->listSeo();
    }
    
    public function previuosNextArticle()
    {
        if (!empty($this->dados['visualizarArtigo'][0])) {
            $articlePreviuosNext = new \Sts\Models\StsArticlePreviousNext();
            $this->dados['artigoAnterior'] = $articlePreviuosNext->viewArticlePrevious(
                    $this->dados['visualizarArtigo'][0]['id']);
            $this->dados['artigoProximo'] = $articlePreviuosNext->viewArticleNext(
                    $this->dados['visualizarArtigo'][0]['id']);
            $this->dados['seo'] = $this->ListSeo->listSeo('sts_artigos', 'slug', $this->article);
            $this->viewCommentaryArticle();
        } else {
            $this->dados['seo'] = $this->ListSeo->listSeo();
        }
    }
    
    public function viewCommentaryArticle()
    {
        $idArticle = $this->dados['visualizarArtigo'][0]['id'];
        $commentaryArticle = new \Sts\Models\StsArticleCommentary();
        $this->dados['artigoComentarios'] = $commentaryArticle->listCommentaryArticle($idArticle);
    }
    
    private function footer()
    {
        $listFooter = new \Sts\Models\StsFooter();
        $this->dados['stsFooter'] = $listFooter->listFooter();
    }
}
