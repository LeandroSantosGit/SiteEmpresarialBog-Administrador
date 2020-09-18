<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsVideo
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsVideoHome
{
    private $result;
    
    public function listVideoHome()
    {
        $video = new \Sts\Models\helper\StsRead();
        $video->exeRead('sts_videos', 'LIMIT :limit', 'limit=1');
        $this->result = $video->getResult();
        return $this->result;
    }
}
