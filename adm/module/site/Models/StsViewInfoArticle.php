<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsViewInfoArticle
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsViewInfoArticle
{
    private $result;
    private $dadoId;
    
    public function viewInfoArticle($dadoId)
    {
        $this->dadoId = (int) $dadoId;
        $viewArticle = new \Module\administrative\Models\helper\AdmsRead();
        $viewArticle->fullRead(
                "SELECT
                    art.*,
                    sit.nome nomeSituation,
                    col.cor color,
                    rob.nome nomeRobot, rob.tipo tipoRobot,
                    user.nome nomeUser,
                    tipAr.nome nomeTypeArticle,
                    catArt.nome nomeCategoryArticle
                FROM
                    sts_artigos art
                INNER JOIN
                    adms_situacao sit
                    ON sit.id = art.adms_sit_id
                INNER JOIN
                    adms_cors col
                    ON col.id = sit.adms_cor_id
                INNER JOIN
                    sts_robots rob
                    ON rob.id = art.sts_robot_id
                INNER JOIN
                    adms_usuarios user
                    ON user.id = art.adms_usuario_id
                INNER JOIN
                    sts_tps_artigos tipAr
                    ON tipAr.id = art.sts_tps_artigo_id
                INNER JOIN
                    sts_cats_artigos catArt
                    ON catArt.id = art.sts_cats_artigo_id
                WHERE art.id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->result = $viewArticle->getResult();
        return $this->result;
    }
}
