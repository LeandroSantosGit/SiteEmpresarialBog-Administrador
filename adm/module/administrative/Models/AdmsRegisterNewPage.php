<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsRegisterNewPage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsRegisterNewPage
{
    private $result;
    private $dados;
    private $emptyIcon;
    private $lastInserted;
    private $listAccess;
    private $listAccessPage;
    private $dadosAccessPage;
    private $levelAccessId;
    
    function getResult()
    {
        return $this->result;
    }
    
    /**
     * Cadastrar página: recebe um array com dados da página
     */
    public function registerPage(array $dados)
    {
        $this->dados = $dados;
        $this->emptyIcon = $this->dados['icone'];
        unset($this->dados['icone']);
        
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInput();
        $validInput->validateInput($this->dados);
        if ($validInput->getResult()) {
            return $this->insertPage();
        }
        return $this->result = false;
    }
    
    /**
     * Página no BD: inserir dados da página no banco de dados
     */
    private function insertPage()
    {
        $this->dados['icone'] = $this->emptyIcon;
        $this->dados['created'] = date("Y-m-d H:i:s");
        $addLevelAccess = new \Module\administrative\Models\helper\AdmsCreate();
        $addLevelAccess->exeCreate("adms_paginas", $this->dados);
        if ($addLevelAccess->getResult()) {
            $this->lastInserted = $addLevelAccess->getResult();
            return $this->insertPermissionAccess();
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Página não encontrada.</div>";
        return $this->result = false;
    }
    
    /**
     * Permissão de acesso: inserir permissão de acesso no nível de acesso.
     * Liberar a permissão de acesso quando for o nével de acesso "Super Administrador",
     * e para outros niveis de acesso não liberar a permissão de acesso a página.
     */
    private function insertPermissionAccess()
    {
        $this->listLevelAccess();
        foreach ($this->listAccess as $levelAccess) {
            extract($levelAccess);
            $this->levelAccessId = $id;
            $this->searchLastOrder();
            $this->dadosAccessPage['permissao'] = ($id == 1 ? 1 : 2);
            $this->dadosAccessPage['ordem'] = $this->listAccessPage[0]['ordem'] + 1;
            $this->dadosAccessPage['adms_niveis_acesso_id'] = $id;
            $this->dadosAccessPage['adms_pagina_id'] = $this->lastInserted;
            $this->dadosAccessPage['created'] = date("Y-m-d H:i:s");
            $addLevelAccPg = new \Module\administrative\Models\helper\AdmsCreate();
            $addLevelAccPg->exeCreate("adms_niveis_acessos_paginas", $this->dadosAccessPage);
            
            if ($addLevelAccPg->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Nova página cadastrada.</div>";
                return $this->result = true;
            }
            $_SESSION['msg'] = "<div class='alert alert-warning'>Nova página cadastrada. 
                    Mais possuí erro ao liberar permissão de nível de acesso.</div>";
            return $this->result = false;
        }
    }
    
    /**
     * Listar nível de acesso: pesquisar os niveis de acesso para liberar a 
     * permissão de acessar a página que está sendo cadastrada.
     */
    private function listLevelAccess()
    {
        $listAccess = new \Module\administrative\Models\helper\AdmsRead();
        $listAccess->fullRead(
                "SELECT id
                FROM adms_niveis_acessos");
        $this->listAccess = $listAccess->getResult();
    }
    
    /**
     * Pesquisar última ordem: Pesquisar o maior número da ordem para o
     * nível de acesso em execução
     */
    private function searchLastOrder()
    {
        $listAccessPg = new \Module\administrative\Models\helper\AdmsRead();
        $listAccessPg->fullRead(
                "SELECT
                    ordem,
                    adms_niveis_acesso_id
                FROM
                    adms_niveis_acessos_paginas
                WHERE
                    adms_niveis_acesso_id =:adms_niveis_acesso_id
                ORDER BY ordem DESC
                LIMIT :limit",
                "adms_niveis_acesso_id={$this->levelAccessId}&limit=1");
        $this->listAccessPage = $listAccessPg->getResult();
        if (!$this->listAccessPage) {
            $this->listAccessPage[0]['ordem'] = 0;
        }
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
