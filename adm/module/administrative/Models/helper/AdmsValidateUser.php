<?php

namespace Module\administrative\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsValidateUser
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsValidateUser
{
    private $user;
    private $result;
    private $editUnique;
    private $dadoId;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function validateUser($user, $editUnique = null, $dadoId = null)
    {
        $this->user = (string) $user;
        $this->editUnique = $editUnique;
        $this->dadoId = $dadoId;
        $uniqueUser = new \Module\administrative\Models\helper\AdmsRead();
        if (!empty($this->editUnique) && ($this->editUnique == true)) {
            $uniqueUser->fullRead("
            SELECT id FROM adms_usuarios WHERE usuario =:usuario AND id <> :id LIMIT :limit",
            "usuario={$this->user}&limit=1&id={$this->dadoId}");
        } else {
            $uniqueUser->fullRead("
            SELECT id FROM adms_usuarios WHERE usuario =:usuario LIMIT :limit",
            "usuario={$this->user}&limit=1");
        }        
        $this->result = $uniqueUser->getResult();
        $this->validateUserUnique();
    }
    
    private function validateUserUnique()
    {
        if (!empty($this->result)) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Usuário já cadastrado</div>";
            return $this->result = false;
        }
        $this->checkCharacters();
    }
    
    private function checkCharacters()
    {
        if ((stristr($this->user, "'")) || (stristr($this->user, " "))) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Usuário possui caracter (') invalido ou espaço em branco</div>";
            return $this->result = false;
        }
        if (stristr($this->user, " ")) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Usuário não permitido espaço em branco</div>";
            return $this->result = false;
        }
        $this->lengthCharacters();
    }

    private function lengthCharacters()
    {
        if (strlen(trim($this->user)) < 5) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Informe usuário com pelo menos 5 caracteres</div>";
            return $this->result = false;
        }
        return $this->result = true;
    }
}
