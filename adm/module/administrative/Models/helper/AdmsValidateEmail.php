<?php

namespace Module\administrative\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsValidateEmail
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsValidateEmail
{
    private $result;
    private $dados;
    private $format;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function validateEmail($email)
    {
        /*$this->dados = (string) $email;
        $this->format = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]+\.[a-z]{2,4}$/';
        
        if (preg_match($this->format, $this->dados)) {
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Email invalido, tente novamente</div>";
        return $this->result = false;*/
        
        $this->dados = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$this->dados) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Email invalido, tente novamente</div>";
            return $this->result = false;
        }
        return $this->result = true;
    }
}
