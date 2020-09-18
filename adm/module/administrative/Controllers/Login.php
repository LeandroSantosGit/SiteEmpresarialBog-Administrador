<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Login
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class Login
{
    private $dados;
    
    public function access()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->removeSendlogin();
        $loadViewAccess = new \Config\ConfigView("administrative/Views/login/access", $this->dados);
        $loadViewAccess->renderViewLogin();
    }
    
    /* Remover sendLogin e manter dados no input */
    private function removeSendlogin() {
        if (!empty($this->dados['sendLogin'])) {
            unset($this->dados['sendLogin']);
            $this->redirectUser();
        }
    }
    
    private function redirectUser()
    {
        $loginModel = new \Module\administrative\Models\AdmsLogin();
        $loginModel->accessLogin($this->dados);
        if ($loginModel->getResult()) {
            $urlRedirect = URLADM . 'home/index';
            return header("Location: $urlRedirect");
        }
        return $this->dados['form'] = $this->dados;
    }
    
    public function logout()
    {
        unset(
            $_SESSION['userId'],
            $_SESSION['userName'],
            $_SESSION['userEmail'],
            $_SESSION['userImage'],
            $_SESSION['userAccessLevel'],
            $_SESSION['userOrdemAcesso']
        );
        $urlRedirect = URLADM . 'login/access';
        header("Location: $urlRedirect");
    }

    /* Renderizar view login */
    private function renderViewLogin()
    {
        $loadViewUser = new \Config\ConfigView("administrative/Views/login/newUser", $this->dados);
        $loadViewUser->renderViewLogin();
    }
}
