<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsEditAuthorArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsEditAuthorArticle
{
    private $result;
    private $dados;
    private $dadoId;
    
    function getResult()
    {
        return $this->result;
    }

    public function viewInfoAuthorArticle($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $authorArticle = new \Module\administrative\Models\helper\AdmsRead();
        $authorArticle->fullRead(
                "SELECT *
                FROM sts_artigos
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $authorArticle->getResult();
        return $this->result;
    }
    
    public function alterAuthorArticle(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->updateEditAuthorArticle();
        }
        return $this->result = false;
    }
    
    private function updateEditAuthorArticle()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateAuthor = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateAuthor->exeUpdate(
                "sts_artigos",
                $this->dados,
                "WHERE id =:id",
                "id={$this->dados['id']}"
        );
        if ($updateAuthor->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Autor do "
                    . "artigo atualizado</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Autor do "
                    . "artigo não atualizado</div>";
        return $this->result = false;
    }
    
    public function listAuthorArticle()
    {
        $list = new \Module\administrative\Models\helper\AdmsRead();
        $list->fullRead("SELECT id idUser, nome nomeUser FROM adms_usuarios ORDER BY nome ASC");
        $register['user'] = $list->getResult();
        
        $this->result = ['user' => $register['user']];
        return $this->result;
    }
}
