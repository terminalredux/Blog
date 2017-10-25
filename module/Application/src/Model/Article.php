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

class Article implements InputFilterAwareInterface
{
    private $inputFilter;
    public $id;
    public $title;
    public $content;
    public $published;
    public $created_at;
    public $updated_at;
    
    public function exchangeArray($row) {
        $this->id = (!empty($row['id'])) ? $row['id'] : null;
        $this->title = (!empty($row['title'])) ? $row['title'] : null;
        $this->content = (!empty($row['content'])) ? $row['content'] : null;
        $this->published = (!empty($row['published'])) ? $row['published'] : null;
        $this->created_at = (!empty($row['created_at'])) ? $row['created_at'] : null;
        $this->updated_at = (!empty($row['updated_at'])) ? $row['updated_at'] : null;
    }
    
    function getId() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function getContent() {
        return $this->content;
    }

    function getPublished() {
        return $this->published;
    }

    function getCreatedAt() {
        return $this->created_at;
    }

    function getUpdatedAt() {
        return $this->updated_at;
    }

    public function getArrayCopy() {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'content' => $this->getContent(),
            'published' => $this->getPublished()
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
            'name' => 'title',
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
                        'min' => 10,
                        'max' => 255,
                    ],
                ]
            ]
        ]);
        
        $inputFilter->add([
            'name' => 'content',
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
                        'min' => 10,
                        'max' => 255,
                    ],
                ]
            ]
        ]);
        
        $inputFilter->add([
            'name' => 'published',
            'required' => false,
            'filters' => [
                ['name' => ToInt::class]
            ],
        ]);
        
        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
        
    }

    public function setInputFilter(InputFilterInterface $inputFilter): InputFilterAwareInterface {
        throw new DomainException('Ta kalsa nie obsługuje dodawnai dodatkowych filtrów wejsciowych');
    }
}
