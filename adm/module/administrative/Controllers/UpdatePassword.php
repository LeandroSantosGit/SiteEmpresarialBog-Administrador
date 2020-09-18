<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ResetPassword
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class UpdatePassword
{
    private $key;
    private $dados;
    
    /* validar link de acesso para atulizar senha */
    public function restorePassword()
    {
        $this->key = filter_input(INPUT_GET, 'key', FILTER_SANITIZE_STRING);
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->key)) {
            $this->checkKey();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-primary'>Erro, link invalido.</div>";
            $urlRedirect = URLADM . 'login/access';
            header("Location: $urlRedirect");
        }
    }
    
    /* verificar se a chave de recuperar senha é valida */
    private function checkKey()
    {
        $validKey = new \Module\administrative\Models\AdmsUpdatePassword();
        $validKey->validateKey($this->key);
        if ($validKey->getResult()) {
            $this->updatePassPrivate();
        } else {            
            $urlRedirect = URLADM . 'login/access';
            header("Location: $urlRedirect");
        }
    }
    
    /*  */
    private function updatePassPrivate()
    {
        if (!empty($this->dados['updatePassUser'])) {
            unset($this->dados['updatePassUser']);
            $this->dados['recuperar_senha'] = $this->key;
            $newPass = new \Module\administrative\Models\AdmsUpdatePassword();
            $newPass->updatePassModel($this->dados);
            if ($newPass->getResult()) {
                $urlRedirect = URLADM . 'login/access';
                return header("Location: $urlRedirect");
            }
        }
        $loadView = new \Config\ConfigView("administrative/Views/login/updatePassword", $this->dados);
        return $loadView->renderViewLogin();
    }
}
