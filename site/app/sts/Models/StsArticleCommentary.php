<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsArticleCommentary
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsArticleCommentary
{
    private $result;
    private $idArticle;
    private $dados;
    private $dadosUser;
    private $userId;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function listCommentaryArticle($idArticle = null)
    {
        $this->idArticle = (string) $idArticle;
        $listCommentary = new \Sts\Models\helper\StsRead();
        $listCommentary->fullRead(
                'SELECT
                    comt.id,
                    comt.conteudo,
                    comt.created,
                    user.id idUser,
                    user.apelido apelidoUser,
                    user.imagem imageUser
                FROM
                    sts_comentario_artigo comt
                INNER JOIN
                    adms_usuarios user
                    ON user.id = comt.adms_usuario_id
                WHERE
                    comt.sts_artigo_id =:sts_artigo_id
                    AND (comt.adms_situacao_id =:adms_situacao_id_ativo
                        OR comt.adms_situacao_id =:adms_situacao_id_analise)
                ORDER BY comt.id DESC',
                "sts_artigo_id={$this->idArticle}&adms_situacao_id_ativo=1&adms_situacao_id_analise=3");
        $this->result = $listCommentary->getResult();
        return $this->result;
    }
    
    public function registerCommentaryArticle(array $dados)
    {
        $this->dados = $dados;
        $this->validateinput();
        if ($this->result) {
            $this->checkUserRegistration();
            unset($this->dados['nome'], $this->dados['apelido'], $this->dados['email'], $this->dados['slug']);
            $this->dados['adms_situacao_id'] = 3;
            $this->dados['created'] = date("Y-m-d H:i:s");
            $this->insertCommentaryArticle();
        }
    }
    
    private function validateinput()
    {
        $this->dados = array_map('strip_tags', $this->dados);
        $this->dados = array_map('trim', $this->dados);
        if (in_array('', $this->dados)) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Preencha todos os campos!</div>";
            return $this->result = false;
        }
        if (filter_var($this->dados['email'], FILTER_VALIDATE_EMAIL)) {
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Email invalido!</div>";
            return $this->result = false;
    }
    
    private function checkUserRegistration()
    {
        $infoUser = new \Sts\Models\helper\StsRead();
        $infoUser->fullRead(
                "SELECT id
                FROM adms_usuarios
                WHERE email =:email
                LIMIT :limit",
                "email={$this->dados['email']}&limit=1");
        $this->userId = $infoUser->getResult();
        if ($this->userId){
            $this->dados['adms_usuario_id'] = $this->userId[0]['id'];
            return $this->result = true;
        }
        return $this->insertUserToCommentArticle();
    }
    
    private function insertUserToCommentArticle()
    {
        $this->dadosUser['nome'] = $this->dados['nome'];
        $this->dadosUser['apelido'] = $this->dados['apelido'];
        $this->dadosUser['email'] = $this->dados['email'];
        $this->dadosUser['usuario'] = $this->dados['email'];
        $this->dadosUser['senha'] = password_hash(password_hash(date("Y-m-d H:i:s"), PASSWORD_DEFAULT), PASSWORD_DEFAULT);
        $this->dadosUser['adms_niveis_acesso_id'] = 5;
        $this->dadosUser['adms_situacao_user_id'] = 3;
        $this->dadosUser['created'] = date("Y-m-d H:i:s");
        
        $registerUser = new \Sts\Models\helper\StsCreate();
        $registerUser->exeCreate("adms_usuarios",$this->dadosUser);
        $resultRegiterUser = $registerUser->getResult();
        if ($resultRegiterUser) {
            $this->dados['adms_usuario_id'] = $resultRegiterUser;
            return $this->result = $resultRegiterUser;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Usuário não cadastrado, tente novamente.</div>";
        return $this->result = false;
    }

    private function insertCommentaryArticle()
    {
        $commentary = new \Sts\Models\helper\StsCreate();
        $commentary->exeCreate('sts_comentario_artigo', $this->dados);
        if ($commentary->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Seu comentário foi enviado!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro, seu comentário foi não enviado!</div>";
            $this->result = false;
        }
    }
}
