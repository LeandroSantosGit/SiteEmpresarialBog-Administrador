<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsContato
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsContato
{
    private $result;
    private $dice;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function registerContact(array $dados)
    {
        $this->dice = $dados;
        $this->validateinput();
        if ($this->result) {
            $this->insertContact();
        }
    }
    
    private function validateinput()
    {
        $this->dice = array_map('strip_tags', $this->dice);
        $this->dice = array_map('trim', $this->dice);
        if (in_array('', $this->dice)) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Preencha todos os campos!</div>";
            return $this->result = false;
        }
        if (filter_var($this->dice['email'], FILTER_VALIDATE_EMAIL)) {
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Email invalido!</div>";
            return $this->result = false;
    }
    
    private function insertContact()
    {
        $contact = new \Sts\Models\helper\StsCreate();
        $contact->exeCreate('sts_contatos', $this->dice);
        if ($contact->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Mensagem enviada!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Mensagem não enviada!</div>";
            $this->result = false;
        }
    }
}
