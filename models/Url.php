<?php

class Url extends MainModel 
{   
    public $id;
    public $real_url;
    public $short_url_slug;
    public $date_expired;
     
    public function fields()
    {
        return array('id', 'real_url', 'short_url_slug', 'date_expired');
    }
     
    public function getByShortUrlSlug($short_url_slug)
    {
        try{                   
            $db = $this->db;
            $sql = 'SELECT * FROM ' . $this->table . ' WHERE short_url_slug = '. $db->quote($short_url_slug); 
            $stmt = $db->query($sql);
            $row = $stmt->fetch();
        }catch(PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        return $row;
    }
}