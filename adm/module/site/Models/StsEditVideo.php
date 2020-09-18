<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsEditVideo
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsEditVideo
{
    private $result;
    private $dados;
    
    function getResult()
    {
        return $this->result;
    }

    public function viewInfoVideo()
    {
        $infoVideo = new \Module\administrative\Models\helper\AdmsRead();
        $infoVideo->fullRead(
                "SELECT *
                FROM sts_videos
                WHERE id =:id
                LIMIT :limit",
                "id=1&limit=1");
        $this->result = $infoVideo->getResult();
        return $this->result;
    }
    
    public function alterVideo(array $dados)
    {
        $this->dados = $dados;
        $validInput = new \Module\administrative\Models\helper\AdmsValidateInputInclideTag();
        $validInput->validateInputTags($this->dados);
        if ($validInput->getResult()) {
            return $this->updateEditVideo();
        }
        return $this->result = false;
    }
    
    private function updateEditVideo()
    {
        $this->dados['modified'] = date("Y-m-d H:i:s");
        $updateVideo = new \Module\administrative\Models\helper\AdmsUpdate();
        $updateVideo->exeUpdate(
                "sts_videos",
                $this->dados,
                "WHERE id =:id",
                "id=1"
        );
        if ($updateVideo->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Vídeo do "
                    . "site atualizado.</div>";
            return $this->result = true;
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Vídeo do "
                . "site não atualizada, tente novamente.</div>";
        return $this->result = false;
    }
}
