<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsDeleteCarousel
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsDeleteCarousel
{
    private $dadoId;
    private $result;
    private $dados;
    private $dadosCarousel;
    private $dadosCarouselBottom;
    
    function getResult()
    {
        return $this->result;
    }

    public function deletarCarousel($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->checkRegisterCarousel();
        if ($this->dadosCarousel) {
            $this->checkBottomCarousel();
            $delete = new \Module\administrative\Models\helper\AdmsDelete();
            $delete->executeDelete(
                    "sts_carousels",
                    "WHERE id =:id",
                    "id={$this->dadoId}"
            );
            if ($delete->getResult()) {
                $this->moveOrder();
                $this->deleteImgCarousel();
                $_SESSION['msg'] = "<div class='alert alert-success'>Slide do"
                        . " carousel apagado.</div>";
                return $this->result = true;
            }
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Slide do"
                . " carousel não apagado.</div>";
       return $this->result = false;
    }
    
    private function deleteImgCarousel()
    {
        $deleteImg = new \Module\administrative\Models\helper\AdmsDeleteImg();
        $deleteImg->deleteImage(
                '../site/assets/images/carousel/'
                    . $this->dadoId
                    . '/'
                    . $this->dadosCarousel[0]['imagem'],
                '../site/assets/images/carousel/' . $this->dadoId
        );
    }

    private function checkRegisterCarousel()
    {
        $viewCarousel = new \Module\administrative\Models\helper\AdmsRead();
        $viewCarousel->fullRead(
                "SELECT imagem
                FROM sts_carousels
                WHERE id =:id
                LIMIT :limit",
                "id={$this->dadoId}&limit=1");
        $this->dadosCarousel = $viewCarousel->getResult();
    }
    
    private function checkBottomCarousel()
    {
        $viewCarousel = new \Module\administrative\Models\helper\AdmsRead();
        $viewCarousel->fullRead(
                "SELECT id, ordem ordemResult
                FROM sts_carousels
                WHERE ordem > (
                        SELECT ordem
                        FROM sts_carousels
                        WHERE id =:id)
                ORDER BY ordem ASC",
                "id={$this->dadoId}");
        $this->dadosCarouselBottom = $viewCarousel->getResult();
    }
    
    private function moveOrder()
    {
        if ($this->dadosCarouselBottom) {
            foreach ($this->dadosCarouselBottom as $actualOrder) {
                extract($actualOrder);
                $this->dados['ordem'] = $ordemResult - 1;
                $this->dados['modified'] = date("Y-m-d H:i:s");
                $updateCarousel = new \Module\administrative\Models\helper\AdmsUpdate();
                $updateCarousel->exeUpdate(
                        "sts_carousels",
                        $this->dados,
                        "WHERE id =:id",
                        "id=" . $id
                );
            }
        }
    }
}
