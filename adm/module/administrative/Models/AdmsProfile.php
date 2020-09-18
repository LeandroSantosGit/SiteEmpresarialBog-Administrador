<?php

namespace Module\administrative\Models;

if (!defined('URL')) {
    header("Location: /");
    exit(); 
}

/**
 * Description of AdmsProfile
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsProfile
{
    private $result;
    
    function getResult()
    {
        return $this->result;
    }

    public function profileUserModel()
    {
        $profileUser = new \Module\administrative\Models\helper\AdmsRead();
        $profileUser->fullRead(
                "SELECT *
                FROM adms_usuarios
                WHERE id =:id
                LIMIT :limit", 
                "id=" . $_SESSION['userId'] . "&limit=1");
        $this->result = $profileUser->getResult();
        return $this->result;
    }
}
