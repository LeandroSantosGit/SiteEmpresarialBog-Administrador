<?php

namespace Module\administrative\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsUpdate
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsUpdate extends AdmsConn
{
    private $table;
    private $dados;
    private $query;
    private $conn;
    private $result;
    private $terms;
    private $values;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function exeUpdate($table, array $dados, $terms = null, $parseString = null)
    {
        $this->table = (string) $table;
        $this->dados = $dados;
        $this->terms = (string) $terms;
        
        parse_str($parseString, $this->values);
        $this->getInstruction();
        $this->executeInstruction();
    }
    
    private function getInstruction()
    {
        foreach ($this->dados as $key => $value) {
            $values[] = $key . '= :' . $key;
        }
        $values = implode(', ', $values);
        $this->query = "UPDATE {$this->table} SET {$values} {$this->terms}";
    }
    
    private function executeInstruction()
    {
        $this->conection();
        try {
            $this->query->execute(array_merge($this->dados, $this->values));
            $this->result = true;
        } catch (Exception $exc) {
            $this->result = false;
        }
    }
    
    private function conection()
    {
        $this->conn = parent::getConn();
        $this->query = $this->conn->prepare($this->query);
    }
}
