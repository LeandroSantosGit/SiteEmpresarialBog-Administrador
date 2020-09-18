<?php

namespace Sts\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsCreate
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsCreate extends StsConn
{
    private $table;
    private $dice;
    private $result;
    private $query;
    private $conn;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function exeCreate($table, array $dados)
    {
        $this->table = (string) $table;
        $this->dice = $dados;
        $this->getInstruction();
        $this->executeInstruction();
    }
    
    private function getInstruction()
    {
        $columns = implode(', ', array_keys($this->dice));
        $values = ':' . implode(', :', array_keys($this->dice));
        $this->query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
    }
    
    private function executeInstruction()
    {
        $this->connection();
        try {
            $this->query->execute($this->dice);
            $this->result = $this->conn->lastInsertId();
        } catch (Exception $exc) {
            $this->result = null;
        }
        }
    
    private function connection()
    {
        $this->conn = parent::getConn();
        $this->query = $this->conn->prepare($this->query);
    }
}
