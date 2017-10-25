<?php
namespace Application\Model;

use Exception;
use Zend\Db\TableGateway\TableGateway;
use Zend\View\Exception\RuntimeException;
use Application\Model\Article;

class ArticleTable 
{
    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
    public function getById($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        
        if (!$row) {
            throw new Exception('nie znaleniono kategorii o id: ' . $id);
        }
        return $row;
    }
    
    public function getBy() 
    {
        $result = $this->tableGateway->select();
        return $result;
    }
}