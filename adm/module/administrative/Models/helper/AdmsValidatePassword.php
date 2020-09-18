<?php

namespace Module\administrative\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsValidatePassword
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsValidatePassword
{
    private $password;
    private $result;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function validatePassword($password)
    {
        $this->password = (string) $password;
        if ((stristr($this->password, "'")) || (stristr($this->password, " "))) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Senha possui caracter (') invalido ou espaço em branco</div>";
            return $this->result = false;
        }
        /*if (stristr($this->password, " ")) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Senha não permitido espaço em branco</div>";
            return $this->result = false;
        }*/
        $this->lengthCharacters();
    }

    private function lengthCharacters()
    {
        if (strlen(trim($this->password)) < 8) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Informe senha com pelo menos 8 caracteres</div>";
            return $this->result = false;
        }
        return $this->result = true;
    }
}
