<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsSynchronizeLevelAccessPage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsSynchronizeLevelAccessPage
{
    private $result;
    private $listLevelAccess;
    private $accessPage;
    private $levelAccessId;
    private $pageId;
    private $listPage;
    private $listAccessPg;
    private $listAccessPgOrder;
    private $liberatePublic;
    
    function getResult()
    {
        return $this->result;
    }
    
    /**
     * Sincrinizar página: Sincronizar as páginas com os níveis de acesso.
     * Para cada nível de acesso ter a permissão cadastrada na tabela.
     */
    public function synchronizeAccPage()
    {
        $this->listLevelAccess();
        if ($this->listLevelAccess) {
            $this->listPageAll();
            if ($this->listPage) {
                $this->readLevelAccess();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Nenhum página encontrada</div>";
                $this->result = false;
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Nenhum nível de acesso encontrado</div>";
            $this->Resultado = false;
        }
    }
    
    /**
     * Listar nível de acesso: Pesquisar os níveis de acesso para liberar a 
     * permissão de acessar as páginas
     */
    private function listLevelAccess()
    {
        $listAccess = new \Module\administrative\Models\helper\AdmsRead();
        $listAccess->fullRead(
                "SELECT id FROM adms_niveis_acessos");
        $this->listLevelAccess = $listAccess->getResult();
    }
    
    /**
     * Listar páginas: Pesquisar as páginas para liberar a permissão para 
     * os níveis de acesso
     */
    private function listPageAll()
    {
        $listPage = new \Module\administrative\Models\helper\AdmsRead();
        $listPage->fullRead(
                "SELECT id, lib_publica FROM adms_paginas");
        $this->listPage = $listPage->getResult();
    }
    
    /**
     * Ler os níveis de acesso: Ler o array de nível de acesso para chamar 
     * o método ler as páginas
     */
    private function readLevelAccess()
    {
        foreach ($this->listLevelAccess as $levelAcc) {
            extract($levelAcc);
            $this->levelAccessId = $id;
            $this->readPage();
        }
    }
    
    /**
     * Ler as páginas: Ler o array de páginas para verificar se o nível de 
     * acesso já possui cadastro da permissão.
     * Caso não tenha cadastro será chamado o método "insertPermissionAccess" 
     * para inserir a permissão
     */
    private function readPage()
    {
        foreach ($this->listPage as $listPg) {
            extract($listPg);
            $this->pageId = $id;
            $this->liberatePublic = $lib_publica;
            $this->searchRegisterPermissionAccess();
            if (!$this->listAccessPg) {
                $this->insertPermissionAccess();
            }
        }
    }
    
    /**
     * Pesquisar a permissão ao nível de acesso: Pesquisar se o nível de acesso
     * já tem a permissão cadastrada para a página
     */
    private function searchRegisterPermissionAccess()
    {
        $listAccessPg = new \Module\administrative\Models\helper\AdmsRead();
        $listAccessPg->fullRead(
                "SELECT id
                FROM adms_niveis_acessos_paginas
                WHERE adms_niveis_acesso_id =:adms_niveis_acesso_id
                    AND adms_pagina_id =:adms_pagina_id",
                "adms_niveis_acesso_id={$this->levelAccessId}&adms_pagina_id={$this->pageId}");
        $this->listAccessPg = $listAccessPg->getResult();
    }
    
    /**
     * Inserir permissão de acesso: Inserir permissão de acesso aos níveis de 
     * acesso para a página pesquisada.
     * Liberado a permissão de acesso quando for o nível de acesso 
     * Super Administrador, para outros níveis de acesso não liberar a 
     * permissão de acesso a página.
     */
    private function insertPermissionAccess()
    {
        $this->accessPage['permissao'] = 
            ( (($this->levelAccessId == 1) || ($this->liberatePublic == 1)) ? 1 : 2);
        $this->searchLastOrder();
        $this->accessPage['ordem'] = $this->listAccessPgOrder[0]['ordem'] + 1;
        $this->accessPage['adms_niveis_acesso_id'] = $this->levelAccessId;
        $this->accessPage['adms_pagina_id'] = $this->pageId;
        $this->accessPage['created'] = date("Y-m-d H:i:s");
        $registerAcePg = new \Module\administrative\Models\helper\AdmsCreate();
        $registerAcePg->exeCreate("adms_niveis_acessos_paginas", $this->accessPage);
        if ($registerAcePg->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Permissão cadastrada</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-dangerErro ao inserir
                permissão ao nível de acesso, tente novamente</div>";
            return $this->result = false;
    }
    
    /**
     * Pesquisar última ordem: Pesquisar o maior número da ordem na tabela 
     * para o nível de acesso em execução
     */
    private function searchLastOrder()
    {
        $listAccessPg = new \Module\administrative\Models\helper\AdmsRead();
        $listAccessPg->fullRead(
                "SELECT ordem, adms_niveis_acesso_id
                FROM adms_niveis_acessos_paginas
                WHERE adms_niveis_acesso_id =:adms_niveis_acesso_id
                ORDER BY ordem DESC
                LIMIT :limit",
                "adms_niveis_acesso_id={$this->levelAccessId}&limit=1");
        $this->listAccessPgOrder = $listAccessPg->getResult();
        if (!$this->listAccessPgOrder) {
            $this->listAccessPgOrder[0]['ordem'] = 0;
        }
    }
}
