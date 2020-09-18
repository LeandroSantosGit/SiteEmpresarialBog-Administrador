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
class NewUser
{
    private $dados;
    
    /* registrar novo usuario */
    public function registerNewUser()
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['registerUserLogin'])) {
            unset($this->dados['registerUserLogin']);
            $this->checkNewUser();
        } else {
            $this->renderViewLogin();
        }
    }
    
    private function checkNewUser()
    {
        $cadNewUser = new \Module\administrative\Models\AdmsNewUser();
        $cadNewUser->registerNewUser($this->dados);
        if ($cadNewUser->getResult()) {
            $urlRedirect = URLADM . 'login/access';
            return header("Location: $urlRedirect");
        }
        $this->dados['form'] = $this->dados;
        return $this->renderViewLogin();
    }

    /* Renderizar view login */
    private function renderViewLogin()
    {
        $loadViewUser = new \Config\ConfigView("administrative/Views/login/newUser", $this->dados);
        $loadViewUser->renderViewLogin();
    }
}
