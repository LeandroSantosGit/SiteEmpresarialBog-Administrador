<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ResertPasssword
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ResetPasssword
{
    private $dados;
    
    
    public function resetPass()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['resetLogin'])) {
            $recoverPass = new \Module\administrative\Models\AdmsResertPassword();
            $recoverPass->resetPasswordUser($this->dados);
            if ($recoverPass->getResult()) {
                $urlRedirect = URLADM . 'login/access';
                header("Location: $urlRedirect");
            } else {
                $this->dados['form'] = $this->dados;
                $loadView = new \Config\ConfigView("administrative/Views/login/resetPasssword", $this->dados);
                $loadView->renderViewLogin();
            }
        } else {
            $loadView = new \Config\ConfigView("administrative/Views/login/resetPasssword", $this->dados);
            $loadView->renderViewLogin();
        }
    }
}
