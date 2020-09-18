<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
}

/**
 * Description of ConfigSendEmail
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ConfigSendEmail
{
    private $dados;
    
    public function sendEmail()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['editConfiEmail'])) {
            unset($this->dados['editConfiEmail']);
            $alterConfigEmail = new \Module\administrative\Models\AdmsConfigSendEmail();
            $alterConfigEmail->alterConfigEmail($this->dados);
            if ($alterConfigEmail->getResult()) {
                $urlRedirect = URLADM . 'config-send-email/send-email';
                return header("Location: $urlRedirect");
            }
            $this->dados['form'] = $this->dados;
            return $this->renderView();
        }
        $infoConfiEmail = new \Module\administrative\Models\AdmsConfigSendEmail();
        $this->dados['form'] = $infoConfiEmail->configEmail();
        return $this->renderView();
    }
    
    private function renderView()
    {
        if ($this->dados['form']) {
            $listMenu = new \Module\administrative\Models\AdmsMenu();
            $this->dados['menu'] = $listMenu->itemMenu();
            $loadView = new \Config\ConfigView("administrative/Views/configEmail/configSendEmail", $this->dados);
            return $loadView->renderView();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Página para 
                configurar email não encontrado.</div>";
        $urlRedirect = URLADM . 'config-send-email/send-email';
        return header("Location: $urlRedirect");
    }
}
