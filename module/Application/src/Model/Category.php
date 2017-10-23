<?php
namespace Application\Model;

class Category 
{
    public $id;
    public $name;
    public $created_at;
    public $updated_at;
    
    public function exchangeArray($row) {
        $this->id = (!empty($row['id'])) ? $row['id'] : null;
        $this->name = (!empty($row['name'])) ? $row['name'] : null;
        $this->created_at = (!empty($row['created_at'])) ? $row['created_at'] : null;
        $this->updated_at = (!empty($row['updated_at'])) ? $row['updated_at'] : null;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getCreatedAt() {
        return $this->created_at;
    }
    
    function getUpdatedAt() {
        return $this->updated_at;
    }
}
