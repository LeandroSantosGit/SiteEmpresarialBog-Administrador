<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsDeleteSobCompany
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsDeleteSobCompany
{
    private $dadoId;
    private $result;
    private $sobCompany;
    private $sobCompanyUnder;
    
    public function deletarSobCompany($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->viewInfoSobCompany();
        if ($this->sobCompany) {
            $this->checkBottomSobCompany();
            $deletarSobCompany = new \Module\administrative\Models\helper\AdmsDelete();
            $deletarSobCompany->executeDelete(
                    "sts_sob_empresa",
                    "WHERE id =:id",
                    "id={$this->dadoId}"
            );
            if ($deletarSobCompany->getResult()) {
                $this->moveOrder();
                $this->deleteImgSobCompany();
                $_SESSION['msg'] = "<div class='alert alert-success'>Tópico "
                        . "sobre empresa apagado.</div>";
                return $this->result = true;
            }
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Tópico sobre "
                . "empresa não apagado.</div>";
       return $this->result = false;
    }
    
    private function deleteImgSobCompany()
    {
        $deleteImg = new \Module\administrative\Models\helper\AdmsDeleteImg();
        $deleteImg->deleteImage(
                '../site/assets/images/imgsInfoCompany/'
                    . $this->dadoId
                    . '/'
                    . $this->sobCompany[0]['imagem'],
                '../site/assets/images/imgsInfoCompany/' . $this->dadoId
        );
    }
    
    private function viewInfoSobCompany()
    {
        $infoSobCompany = new \Module\administrative\Models\helper\AdmsRead();
        $infoSobCompany->fullRead(
                "SELECT imagem
                FROM sts_sob_empresa
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->sobCompany = $infoSobCompany->getResult();
    }
    
    private function checkBottomSobCompany()
    {
        $infoSobCompany = new \Module\administrative\Models\helper\AdmsRead();
        $infoSobCompany->fullRead(
                "SELECT id, ordem ordemResult
                FROM sts_sob_empresa
                WHERE ordem > (
                        SELECT ordem
                        FROM sts_sob_empresa
                        WHERE id =:id)
                ORDER BY ordem ASC",
                "id={$this->dadoId}");
        $this->sobCompanyUnder = $infoSobCompany->getResult();
    }
    
    private function moveOrder()
    {
        if ($this->sobCompanyUnder) {
            foreach ($this->sobCompanyUnder as $actualOrder) {
                extract($actualOrder);
                $this->dados['ordem'] = $ordemResult - 1;
                $this->dados['modified'] = date("Y-m-d H:i:s");
                $updateCarousel = new \Module\administrative\Models\helper\AdmsUpdate();
                $updateCarousel->exeUpdate(
                        "sts_sob_empresa",
                        $this->dados,
                        "WHERE id =:id",
                        "id=" . $id
                );
            }
        }
    }
}
