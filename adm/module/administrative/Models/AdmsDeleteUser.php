<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsDeleteUser
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsDeleteUser
{
    private $dadoId;
    private $dadosUser;
    
    public function removeuser($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->viewInfoUser();
        if ($this->dadosUser) {
            $deleUser = new \Module\administrative\Models\helper\AdmsDelete();
            $deleUser->executeDelete("adms_usuarios", "WHERE id =:id", "id={$this->dadoId}");
            if ($deleUser->getResult()) {
                $deleteImg = new \Module\administrative\Models\helper\AdmsDeleteImg();
                $deleteImg->deleteImage('assets/image/user/'
                        . $this->dadoId . '/' . $this->dadosUser[0]['imagem'],
                        'assets/image/user/' . $this->dadoId);
                $_SESSION['msg'] = "<div class='alert alert-success'>Usuário apagado com sucesso.</div>";
                return $this->result = true;
            }
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Usuário não apagado, tente novamente.</div>";
        return $this->result = false;
    }
    
    public function viewInfoUser()
    {
        $viewUser = new \Module\administrative\Models\helper\AdmsRead();
        $viewUser->fullRead(
                "SELECT
                    user.imagem
                FROM
                    adms_usuarios user
                INNER JOIN
                    adms_niveis_acessos nivac
                    ON nivac.id = user.adms_niveis_acesso_id
                WHERE
                    user.id =:id
                    AND nivac.ordem >:ordem
                LIMIT :limit",
                "id={$this->dadoId}&ordem=" . $_SESSION['userOrdemAcesso'] . "&limit=1");
        $this->dadosUser = $viewUser->getResult();
    }
}
