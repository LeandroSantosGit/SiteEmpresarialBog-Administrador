<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of RegisterNewArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class RegisterNewArticle
{
    private  $dados;
    
    public function registerInfoArticle()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['registerArticle'])) {
            unset($this->dados['registerArticle']);
            $this->dados['imageNew'] = ($_FILES['imageNew'] ? $_FILES['imageNew'] : null);
            $addArticle = new \Module\site\Models\StsRegisterNewArticle();
            $addArticle->registerArticle($this->dados);
            if ($addArticle->getResult()) {
                $urlRedirect = URLADM . 'list-article/list-info-article';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        return $this->renderView();
    }
    
    private function renderView()
    {
        $listSelect = new \Module\site\Models\StsRegisterNewArticle();
        $this->dados['select'] = $listSelect->listArticles();
        
        $button = [
            'listArticle' => [
                'menu_controller' => 'list-article',
                'menu_metodo' => 'list-info-article'],
            'editAuthorArticle' => [
                'menu_controller' => 'edit-author-article',
                'menu_metodo' => 'edit-info-author-article']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsArticle'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $loadView = new \Config\ConfigView(
                "site/Views/article/registerNewArticle",
                $this->dados
        );
        return $loadView->renderView();
    }
}
