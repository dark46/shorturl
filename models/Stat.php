<?php

class Stat extends MainModel 
{
    public $id;
    public $ip;
    public $user_agent;
    public $country;
    public $city;    
    public $date_visit;
     
    public function fields()
    {
        return array('id', 'url_id', 'ip', 'user_agent', 'country', 'city', 'date_visit');
    }
     
    public function getCitiesStat($url_id)
    {
        try {            
            $db = $this->db;
            $sql = 'SELECT city, count(*) as count  FROM stat WHERE url_id = '.$db->quote($url_id).' GROUP BY city';
            $stmt = $db->query($sql);
            $rows = $stmt->fetchAll();
        } catch(PDOException $e) {
            echo $e->getMessage();
            exit;
        } 
        return $rows;
    }  

    public function getBrowserStat($url_id)
    {
        try {            
            $db = $this->db;
            $sql = 'SELECT user_agent, count(*) as count  FROM stat WHERE url_id = '.$db->quote($url_id).' GROUP BY user_agent';
            $stmt = $db->query($sql);
            $rows = $stmt->fetchAll();
        } catch(PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        return $rows;
    }

    public function getHitsByDate($url_id, $date)
    {
        try {            
            $db = $this->db;
            $sql = 'SELECT count(*) as count  FROM stat WHERE url_id = '.$db->quote($url_id).' AND DATE(date_visit) = ' . $db->quote($date);
            $stmt = $db->query($sql);
            $rows = $stmt->fetchAll();
        } catch(PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        return $rows;
    }

    public function getHitsAllDates($url_id)
    {
        try {            
            $db = $this->db;
            $sql = 'SELECT count(*) as count  FROM stat WHERE url_id = '.$db->quote($url_id); 
            $stmt = $db->query($sql);
            $rows = $stmt->fetchAll();
        } catch(PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        return $rows;
    }

    public function getHostsByDate($url_id, $date)
    {
        try {              
            $db = $this->db;
            $sql = 'SELECT * FROM stat WHERE url_id = '.$db->quote($url_id).' AND DATE(date_visit) = ' . $db->quote($date) . ' GROUP BY "ip"';
            $stmt = $db->query($sql);
            $rows = $stmt->fetchAll();
        } catch(PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        return $rows;
    }

    public function getHostsAllDates($url_id)
    {
        try {            
            $db = $this->db;
            $sql = 'SELECT * FROM stat WHERE url_id = '.$db->quote($url_id).' GROUP BY "ip"';
            $stmt = $db->query($sql);
            $rows = $stmt->fetchAll();
        } catch(PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        return $rows;
    }
}