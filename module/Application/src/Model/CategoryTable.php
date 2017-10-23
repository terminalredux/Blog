<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class CategoryTable 
{
    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
    public function getById($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        
        if (!$row) {
            throw new \Exception('nie znaleniono kategorii o id: ' . $id);
        }
        return $row;
    }
}

