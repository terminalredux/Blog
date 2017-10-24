<?php
namespace Application\Model;

use Exception;
use Zend\Db\TableGateway\TableGateway;
use Zend\View\Exception\RuntimeException;
use Application\Model\Category;

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
            throw new Exception('nie znaleniono kategorii o id: ' . $id);
        }
        return $row;
    }
    
    public function getBy() 
    {
        $result = $this->tableGateway->select();
        return $result;
    }
    
    public function save(Category $categoryModel)
    {
        $data = [
            'name' => $categoryModel->getName(),
            'created_at' => time(),
            'updated_at' => time()
        ];
        $id = $categoryModel->getId();

        if ($id == 0) {
            $this->tableGateway->insert($data);
            return;
        }
        if (!$this->getById($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update album with identifier %d; does not exist',
                $id
            ));
        }
        $this->tableGateway->update($data, ['id' => $id]);
    }
}

