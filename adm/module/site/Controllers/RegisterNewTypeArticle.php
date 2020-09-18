<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of RegisterNewTypeArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class RegisterNewTypeArticle
{
    private $dados;
    
    public function registerInfoTypeArticle()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['registerTypeArticle'])) {
            unset($this->dados['registerTypeArticle']);
            $addTypeArticle = new \Module\site\Models\StsRegisterNewTypeArticle();
            $addTypeArticle->registerTypeArticle($this->dados);
            if ($addTypeArticle->getResult()) {
                $urlRedirect = URLADM . 'list-type-article/list-info-type-article';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        return $this->renderView();
    }
    
    private function renderView()
    {
        $button = [
            'listTypeArticle' => [
                'menu_controller' => 'list-type-article',
                'menu_metodo' => 'list-info-type-article']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsTypeArticle'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $loadView = new \Config\ConfigView(
                "site/Views/typeArticle/registerNewTypeArticle",
                $this->dados
        );
        return $loadView->renderView();
    }
}
