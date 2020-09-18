<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ConfirmEmail
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ConfirmEmail
{
    private $valueKey;
    
    public function confirmEmailUser()
    {
        $this->valueKey = filter_input(INPUT_GET, 'key', FILTER_SANITIZE_STRING);
        if (!empty($this->valueKey)) {
            $configEmail = new \Module\administrative\Models\AdmsConfirmEmail();
            $configEmail->confirmEmailUser($this->valueKey);
            
            if ($configEmail->getResult()) {
                $urlRedirect = URLADM . 'login/access';
                header("Location: $urlRedirect");
            } else {
                $urlRedirect = URLADM . 'login/access';
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Link de confimação invalido</div>";
            $urlRedirect = URLADM . 'login/access';
            header("Location: $urlRedirect");
        }
    }
}
