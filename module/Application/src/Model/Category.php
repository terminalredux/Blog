<?php
namespace Application\Model;

use Zend\Hydrator\Exception\DomainException;
use Zend\Filter\ {
    StringTrim,
    StripTags,
    ToInt
};
use \Zend\InputFilter\ {
    InputFilter,
    InputFilterAwareInterface,
    InputFilterInterface
};
use Zend\Validator\StringLength;

class Category implements InputFilterAwareInterface
{
    private $inputFilter;
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
    
    public function getArrayCopy() {
        return [
            'id' => $this->getId(),
            'name' => $this->getName()
        ];
    }

    public function getInputFilter(): InputFilterInterface {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }
        $inputFilter = new InputFilter();
        
        $inputFilter->add([
            'name' => 'id',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class]
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'name',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class]
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ]
            ]
        ]);
        
        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
        
    }

    public function setInputFilter(InputFilterInterface $inputFilter): InputFilterAwareInterface {
        throw new DomainException('Ta kalsa nie obsługuje dodawnai dodatkowych filtrów wejsciowych');
    }

}
