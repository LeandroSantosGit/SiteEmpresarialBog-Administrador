<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsEditRegisterUserLogin
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsEditRegisterUserLogin
{
    private $result;
    private $dados;
    
    function getResult()
    {
        return $this->result;
    }

    public function viewInforRegisterUser()
    {
        $infoUser = new \Module\administrative\Models\helper\AdmsRead();
        $infoUser->fullRead(
                "SELECT *
                FROM adms_cadastro_user
                WHERE id =:id
                LIMIT :limit",
                "id=1&limit=1");
        $this->result = $infoUser->getResult();
        return $this->result;
    }
    
    public function alterInfoUser(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->updateNewRegisterUser();
        }
        return $this->result = false;
    }
    
    private function updateNewRegisterUser()
    {
        $this->dadoId['modified'] = date("Y-m-d H:i:s");
        $updateInfoUser = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateInfoUser->exeUpdate(
                "adms_cadastro_user",
                $this->dados,
                "WHERE id =:id",
                "id=1"
        );
        if ($updateInfoUser->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Informações 
                    de login do usuário atualizado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Informações
                    de login do usuário não atualizada, tente novamente.</div>";
        return $this->result = false;
    }
    
    public function listRegisterUser()
    {
        $list = new \Module\administrative\Models\helper\AdmsRead();
        $list->fullRead("SELECT id idNivac, nome nomeNivac FROM adms_niveis_acessos ORDER BY nome ASC");
        $register['levAccs'] = $list->getResult();
        
        $list->fullRead("SELECT id idSitUser, nome nomeSitUser FROM adms_situacao_users ORDER BY nome ASC");
        $register['sitUser'] = $list->getResult();
        
        $this->result = ['levAccs' => $register['levAccs'], 'sitUser' => $register['sitUser']];
        return $this->result;
    }
}
