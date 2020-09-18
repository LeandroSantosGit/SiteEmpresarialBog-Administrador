<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsEditSeo
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsEditSeo
{
    private $result;
    private $dados;
    
    function getResult()
    {
        return $this->result;
    }

    public function viewInfoSeo()
    {
        $viewSeo = new \Module\administrative\Models\helper\AdmsRead();
        $viewSeo->fullRead(
                "SELECT *
                FROM sts_seo
                WHERE id =:id
                LIMIT :limit",
                "id=1&limit=1");
        $this->result = $viewSeo->getResult();
        return $this->result;
    }
    
    public function alterInfoSeo(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->updateNewInfoSeo();
        }
        return $this->result = false;
    }
    
    private function updateNewInfoSeo()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateSeo = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateSeo->exeUpdate(
                "sts_seo",
                $this->dados,
                "WHERE id =:id",
                "id=1"
        );
        if ($updateSeo->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Seo "
                    . " atualizado</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Seo "
                    . " não atualizado</div>";
        return $this->result = false;
    }
}
