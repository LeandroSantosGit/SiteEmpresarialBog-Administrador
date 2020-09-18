<?php

namespace Module\administrative\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsEmailUnique
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsEmailUnique
{
    private $email;
    private $result;
    private $editEmail;
    private $dadoId;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function validateEmailUnique($email, $editEmail = null, $dadoId = null)
    {
        $this->email = (string) $email;
        $this->editEmail = $editEmail;
        $this->dadoId = $dadoId;
        $uniqueEmail = new \Module\administrative\Models\helper\AdmsRead();
        if (!empty($this->editEmail) && ($this->editEmail == true)) {
            $uniqueEmail->fullRead("
            SELECT id FROM adms_usuarios WHERE email =:email AND id <> :id LIMIT :limit",
            "email={$this->email}&limit=1&id={$this->dadoId}");
        } else {
            $uniqueEmail->fullRead("
            SELECT id FROM adms_usuarios WHERE email =:email LIMIT :limit",
            "email={$this->email}&limit=1");
        }        
        $this->result = $uniqueEmail->getResult();
        $this->checkEmailUnique();
    }
    
    private function checkEmailUnique()
    {
        if (!empty($this->result)) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Email já cadastrado</div>";
            return $this->result = false;
        }
        return $this->result = true;
    }
}
