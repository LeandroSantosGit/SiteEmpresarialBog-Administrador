<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of RegisterNewCategoryArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class RegisterNewCategoryArticle
{
    private $dados;
    
    public function registerInfoCategoryArticle()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['registerCatArticle'])) {
            unset($this->dados['registerCatArticle']);
            $addCatArticle = new \Module\site\Models\StsRegisterNewCategoryArticle();
            $addCatArticle->registerCategoryArticle($this->dados);
            if ($addCatArticle->getResult()) {
                $urlRedirect = URLADM . 'list-category-article/list-info-category-article';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        return $this->renderView();
    }
    
    private function renderView()
    {
        $listSelect = new \Module\site\Models\StsRegisterNewCategoryArticle();
        $this->dados['select'] = $listSelect->listCategoryArticle();
        
        $button = [
            'listCatArticle' => [
                'menu_controller' => 'list-category-article',
                'menu_metodo' => 'list-info-category-article']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsCatArticle'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $loadView = new \Config\ConfigView(
                "site/Views/categoryArticle/registerNewCategoryArticle",
                $this->dados
        );
        return $loadView->renderView();
    }
}
