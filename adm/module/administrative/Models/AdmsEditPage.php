<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsEditPage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsEditPage
{
    private $result;
    private $dados;
    private $dadoId;
    
    function getResult()
    {
        return $this->result;
    }

    /**
     * Ver página: receber o id da página para buscar informações do registro 
     * no banco de dados
     */
    public function viewInfoPage($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewPage = new \Module\administrative\Models\helper\AdmsRead();
        $viewPage->fullRead(
                "SELECT *
                FROM adms_paginas
                WHERE id =:id
                LIMIT :limit",
                "id=$this->dadoId&limit=1");
        $this->result = $viewPage->getResult();
        return $this->result;
    }
    
    /**
     * Editar página: receber array de dados com as informações da página
     */
    public function AdmsEditPage(array $dados)
    {
        $this->dados = $dados;
        $this->emptyIcon = $this->dados['icone'];
        unset($this->dados['icone']);
        
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->updateEditPage();
        }
        return $this->result = false;
    }
    
    /**
     * Editar página no banco: instancia a classe responsavél em editar no banco
     * Verificar status da ação, true ou false.
     */
    private function updateEditPage()
    {
        $this->dados['icone'] = $this->emptyIcon;
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updatePage = new \Module\administrative\Models\helper\AdmsUpdate();
        $updatePage->exeUpdate(
                "adms_paginas",
                $this->dados,
                "WHERE id =:id",
                "id=" . $this->dados['id']
        );
        if ($updatePage->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Página foi atualizada.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Página não foi atualizada.</div>";
        return $this->result = false;
    }
    
    /**
     * Listar registro para chave estrangeira: buscar informações nas tabelas
     * para utilizar como chave estrangeira.
     */
    public function listRegisterPage()
    {
        $list = new \Module\administrative\Models\helper\AdmsRead();
        $list->fullRead("SELECT id idGrPg, nome nomeGrPg FROM adms_grupos_paginas ORDER BY nome ASC");
        $register['grPg'] = $list->getResult();
        
        $list->fullRead("SELECT id idTpPg, tipo tipoTpPg, nome nomeTpPg FROM adms_tipos_paginas ORDER BY nome ASC");
        $register['tpPg'] = $list->getResult();
        
        $list->fullRead("SELECT id idSitPg, nome nomeSitPg FROM adms_situacao_paginas ORDER BY nome ASC");
        $register['sitPg'] = $list->getResult();
        
        $this->result = ['grPg' => $register['grPg'], 'tpPg' => $register['tpPg'], 'sitPg' => $register['sitPg']];
        return $this->result;
    }
}
