<?php

namespace Module\administrative\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsDelete
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsDelete extends AdmsConn
{
    private $table;
    private $terms;
    private $values;
    private $result;
    private $query;
    private $conn;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function executeDelete($table, $terms, $parseString)
    {
        $this->table = (string) $table;
        $this->terms = (string) $terms;
        parse_str($parseString, $this->values);
        
        $this->executeInstruction();
    }
    
    private function executeInstruction()
    {
        $this->query = "DELETE FROM {$this->table} {$this->terms}";
        $this->connection();
        try {
            $this->query->execute($this->values);
            $this->result = true;
        } catch (Exception $exc) {
            $this->result = true;
        }
        }
    
    private function connection()
    {
        $this->conn = parent::getConn();
        $this->query = $this->conn->prepare($this->query);
    }
}
