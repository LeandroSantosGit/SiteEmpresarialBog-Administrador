<?php

namespace Module\site\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsDeleteRobots
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsDeleteRobots
{
    private $dadoId;
    private $result;
    
    public function deleteRobots($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->checkRegisterPagesRobots();
        if ($this->result) {
            $deleteRobots = new \Module\administrative\Models\helper\AdmsDelete();
            $deleteRobots->executeDelete(
                    "sts_robots",
                    "WHERE id =:id",
                    "id={$this->dadoId}"
            );
            if ($deleteRobots->getResult()) {
               $_SESSION['msg'] = "<div class='alert alert-success'>Robots apagado.</div>";
                return $this->result = true;
            }
            $_SESSION['msg'] = "<div class='alert alert-danger'>Robots não apagado.</div>";
            return $this->result = false;
        }
    }
    
    private function checkRegisterPagesRobots()
    {
        $viewRobots = new \Module\administrative\Models\helper\AdmsRead();
        $viewRobots->fullRead(
                "SELECT id
                FROM sts_paginas
                WHERE sts_robot_id =:sts_robot_id
                LIMIT :limit",
                "sts_robot_id={$this->dadoId}&limit=2");
        if ($viewRobots->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Robots não pode "
                . "ser apagado apagado, há pagina cadastrada com este robot.</div>";
            return $this->result = false;
        }
        return $this->checkRegisterArticlesRobots();
    }
    
    private function checkRegisterArticlesRobots()
    {
        $viewRobots = new \Module\administrative\Models\helper\AdmsRead();
        $viewRobots->fullRead(
                "SELECT id
                FROM sts_artigos
                WHERE sts_robot_id =:sts_robot_id
                LIMIT :limit",
                "sts_robot_id={$this->dadoId}&limit=2");
        if ($viewRobots->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Robots não pode "
                . "ser apagado apagado, há artigo cadastrado com este robot.</div>";
            return $this->result = false;
        }
        return $this->result = true;
    }
}
