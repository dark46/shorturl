<?php

abstract class MainModel 
{
    protected $db;   
    protected $table;
 
    public function __construct() 
    {
        global $DB;
        $this->db = $DB;
        $this->table = strtolower(get_class($this));
    }

    public function getById($id) 
    {
        try {    
            $db = $this->db;
            $sql = 'SELECT * FROM ' .$this->table. ' WHERE id = '.$db->quote($id);
            $stmt = $db->query($sql);
            $row = $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        return $row;
    }    

    public function save() 
    {
        $fields = $this->fields();
        $sqlFields = '';
        $sqlPlaceholders = '';
        $str = '';
        foreach ($fields as $field) {
            if (!empty($sqlFields)) $str = ', ';
            if (isset($this->$field)) {
                $sqlFields .= $str . $field;
                $sqlPlaceholders .= $str . '?';
                $params[] = $this->$field; 
            }
        }
        try {
            $db = $this->db;
            $stmt = $db->prepare('INSERT INTO ' . $this->table .' (' . $sqlFields . ') values (' . $sqlPlaceholders .')');  
            $result = $stmt->execute($params);
            return ['id' => $db->lastInsertId()];
        } catch(PDOException $e) {
            echo $e->getMessage();
            exit();
        }   
    }

    public function deleteById($id)
    { 
        try {
            $db = $this->db;
            $result = $db->exec('DELETE FROM ' . $this->table . ' WHERE `id` = ' . $db->quote($id));
            return $result;
        } catch(PDOException $e) {
            echo $e->getMessage();
            exit();
        }           
    }

    public function deleteWhere($cond)
    { 
        try {
            $db = $this->db;
            $result = $db->exec('DELETE FROM ' . $this->table . ' WHERE ' . $cond);
            return $result;
        } catch(PDOException $e) {
            echo $e->getMessage(); 
            exit();
        }           

    }
}    

