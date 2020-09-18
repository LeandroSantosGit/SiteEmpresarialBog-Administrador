<?php

namespace Module\administrative\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsCreate
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsCreate extends AdmsConn
{
    private $table;
    private $dados;
    private $query;
    private $conn;
    private $result;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function exeCreate($table, array $dados)
    {
        $this->table = (string) $table;
        $this->dados = $dados;
        $this->getInstruction();
        $this->runInstruction();
    }
    
    private function getInstruction()
    {
        $column = implode(', ', array_keys($this->dados));
        $values = ':' . implode(', :', array_keys($this->dados));
        $this->query = "INSERT INTO {$this->table} ({$column}) VALUES ({$values})";
        echo $this->query;
    }
    
    private function runInstruction()
    {
        $this->conection();
        try {
            $this->query->execute($this->dados);
            $this->result = $this->conn->lastInsertId();
        } catch (Exception $exc) {
            $this->result = null;
        }
    }
    
    private function conection()
    {
        $this->conn = parent::getConn();
        $this->query = $this->conn->prepare($this->query);
    }
}
