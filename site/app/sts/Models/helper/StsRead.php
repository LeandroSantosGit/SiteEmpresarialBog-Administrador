<?php

namespace Sts\Models\helper;

use PDO;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsRead
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsRead extends StsConn
{
    private $select;
    private $values;
    private $result;
    private $query;
    private $conn;
    
    function getResult()
    {
        return $this->result;
    }
    
    public function exeRead($table, $terms = null, $parseString = null)
    {
        if (!empty($parseString)) {
            parse_str($parseString, $this->values);
        }
        $this->select = "SELECT * FROM {$table} {$terms}";
        $this->exeInstruction();
    }
    
    public function fullRead($query, $parseString = null)
    {
        $this->select = (string) $query;
        if (!empty($parseString)) {
            parse_str($parseString, $this->values);
        }
        $this->exeInstruction();
    }
    
    private function exeInstruction()
    {
        $this->conection();
        try {
            $this->getInstruction();
            $this->query->execute();
            $this->result = $this->query->fetchAll();
        } catch (Exception $exc) {
            $this->result = null;
        }
    }
    
    private function conection()
    {
        $this->conn = parent::getConn();
        $this->query = $this->conn->prepare($this->select);
        $this->query->setFetchMode(PDO::FETCH_ASSOC);
    }
    
    private function getInstruction()
    {
        if ($this->values) {
            foreach ($this->values as $Link => $Valor) {
                if ($Link == 'limit' || $Link == 'offset') {
                    $Valor = (int) $Valor;
                }
                $this->query->bindValue(":{$Link}", $Valor,
                        (is_int($Valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
            }
        }
    }
}
