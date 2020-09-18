<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditAboutArticles
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class EditAboutArticles
{
    private $dados;
    
    public function editInfoArticles()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['editAboutArticle'])) {
            unset($this->dados['editAboutArticle']);
            $this->dados['imageNew'] = ($_FILES['imageNew'] ? $_FILES['imageNew'] : null);
            $editAboutArticle = new \Module\site\Models\StsEditAboutArticles();
            $editAboutArticle->alterAboutArticle($this->dados);
            if ($editAboutArticle->getResult()) {
                $urlRedirect = URLADM . 'edit-about-articles/edit-info-articles';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoAboutArticle = new \Module\site\Models\StsEditAboutArticles();
        $this->dados['form'] = $infoAboutArticle->viewInfoAboutArticle();
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $listSelect = new \Module\site\Models\StsEditAboutArticles();
            $this->dados['select'] = $listSelect->listSituationAboutArticle();

            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView(
                    "site/Views/editAboutArticles/editAboutArticles",
                    $this->dados
            );
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Erro, não encontrado "
                . "registro para editar sobre artigo.</div>";
        $urlRedirect = URLADM . 'home/index';
        return header("Location: $urlRedirect");
    }
}
