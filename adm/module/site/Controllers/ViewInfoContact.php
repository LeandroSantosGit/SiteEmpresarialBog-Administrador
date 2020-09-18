<?php

namespace Module\site\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ViewInfoContact
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ViewInfoContact
{
    private $dados;
    private $dadoId;
    
    public function detailInfoContact($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        if (!empty($this->dadoId)) {
            $infoMsgContact = new \Module\site\Models\StsViewInfoContact();
            $this->dados['infoContact'] = 
                    $infoMsgContact->viewInfoMsgContact($this->dadoId);
            $button = [
                'listContact' => [
                    'menu_controller' => 'list-contact',
                    'menu_metodo' => 'list-info-contact'],
                'deleteContact' => [
                    'menu_controller' => 'delete-contact',
                    'menu_metodo' => 'remove-contact']
            ];
            $listButton = new \Module\administrative\Models\AdmsButton();
            $this->dados['buttonsContact'] = $listButton->validateButton($button);
            
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();

            $loadView = new \Config\ConfigView(
                    "site/Views/contact/viewInfoContact",
                    $this->dados
            );
            $loadView->renderView();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Mensagem de "
                    . "contato não encontrado.</div>";
            $urlRedirect = URLADM . 'list-contact/list-info-contact';
            header("Location: $urlRedirect");
        }
    }
}
