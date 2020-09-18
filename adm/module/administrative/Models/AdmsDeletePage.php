<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsDeletePage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsDeletePage
{
    private $dadoId;
    private $result;
    private $updateNivAccess;
    private $nivAccessPg;
    private $dadosNivAccess;
    
    function getResult()
    {
        return $this->result;
    }
    
    /**
     * Ver página: receber id da página para apagar o registro do banco
     * Chamar método searchNivAccess para verificar a permissões com número da 
     * ordem maior da qual será apagada.
     */
    public function deletePage($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->searchNivAccess();
        $deletePg = new \Module\administrative\Models\helper\AdmsDelete();
        $deletePg->executeDelete("adms_paginas", "WHERE id =:id", "id=$this->dadoId");
        if ($deletePg->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Página apagada</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Página não apagada</div>";
        return $this->result = false;
    }
    
    /**
     * Pesquisar nível de acesso: pesquisar no banco os níveis de acesso
     */
    private function searchNivAccess()
    {
        $nivAccess = new \Module\administrative\Models\helper\AdmsRead();
        $nivAccess->exeRead("SELECT id idNivAc FROM adms_niveis_acessos ORDER BY id ASC");
        $this->dadosNivAccess = $nivAccess->getResult();
        $this->searchLevelAccPg();
    }
    
    /**
     * Pesquisar as permissões: pesquisar no banco as permissões dos níveis de 
     * acesso na tabela
     */
    private function searchLevelAccPg()
    {
        if ($this->dadosNivAccess) {
            foreach ($this->dadosNivAccess as $nivAccess) {
                extract($nivAccess);
                $nivAccePg = new \Module\administrative\Models\helper\AdmsRead();
                $nivAccePg->exeRead(
                        "SELECT id idNivAcpg, ordem
                        FROM adms_niveis_acessos_paginas
                        WHERE adms_niveis_acesso_id =:Aadms_niveis_acesso_id
                              AND ordem > (
                                SELECT ordem
                                FROM adms_niveis_acessos_paginas
                                WHERE adms_pagina_id =:adms_pagina_id
                                      AND adms_niveis_acesso_id =:Badms_niveis_acesso_id)
                        ORDER BY id ASC",
                        "Aadms_niveis_acesso_id={$idNivAc}&adms_pagina_id={$this->dadoId}&Badms_niveis_acesso_id={$idNivAc}");
                $this->nivAccessPg = $nivAccePg->getResult();
                $this->moveOrder();
                $deleteNivAcpg = new \Module\administrative\Models\helper\AdmsDelete();
                $deleteNivAcpg->executeDelete(
                        "adms_niveis_acessos_paginas",
                        "WHERE adms_pagina_id =:adms_pagina_id
                               AND adms_niveis_acesso_id =: adms_niveis_acesso_id",
                        "adms_pagina_id={$this->dadoId}&adms_niveis_acesso_id=$idNivAc");
            }
        }
    }
    
    private function moveOrder()
    {
        if ($this->nivAccessPg) {
            foreach ($this->nivAccessPg as $nivAccPg) {
                extract($nivAccPg);
                $this->updateNivAccess['ordem'] = $ordem - 1;
                $this->updateNivAccess['modified'] = date("Y-m-d H:i:s");
                $updateNivAcc = new \Module\administrative\Models\helper\AdmsRead();
                $updateNivAcc->exeRead(
                        "adms_niveis_acessos_paginas",
                        $this->updateNivAccess,
                        "WHERE id =:id",
                        "id=" . $idNivAcpg);
            }
        }
    }
}
