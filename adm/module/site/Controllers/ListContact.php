<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ListContact
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ListContact
{
    private $dados;
    private $pageId;
    
    public function listInfoContact($pageId = null)
    {
        $this->pageId = (int) $pageId ? $pageId : 1;
        $button = [
            'viewContact' => [
                'menu_controller' => 'view-info-contact',
                'menu_metodo' => 'detail-info-contact'],
            'deleteContact' => [
                'menu_controller' => 'delete-contact',
                'menu_metodo' => 'remove-contact']
        ];
        $listButton = new \Module\administrative\Models\AdmsButton();
        $this->dados['buttonsContact'] = $listButton->validateButton($button);
        
        $listMenu = new \Module\administrative\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $listContact = new \Module\site\Models\StsListContact();
        $this->dados['listContact'] = $listContact->listInfoContact($this->pageId);
        $this->dados['pagination'] = $listContact->getResultPg();
        
        $loadView = new \Config\ConfigView("site/Views/contact/listContact", $this->dados);
        $loadView->renderView();
    }
}
