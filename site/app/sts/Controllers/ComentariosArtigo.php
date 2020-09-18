<?php

namespace App\sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ComentariosArtigo
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ComentariosArtigo
{
    private $dados;
    
    public function index()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['registerNewCommentaryUser'])) {
            unset($this->dados['registerNewCommentaryUser']);
            $addCommentary = new \Sts\Models\StsArticleCommentary();
            $addCommentary->registerCommentaryArticle($this->dados);
            if ($addCommentary->getResult()) {
                $this->dados['form'] = null;
                unset($_SESSION['form']);
                $urlRedirect = URL . "artigo/" . $this->dados['slug'] . "#msg_comentario";
                header("Location: $urlRedirect");
            } else {
                $_SESSION['form'] = $this->dados;
                $urlRedirect = URL . "artigo/" . $this->dados['slug'] . "#msg_comentario";
                return header("Location: $urlRedirect");
            }
        }
    }
}
