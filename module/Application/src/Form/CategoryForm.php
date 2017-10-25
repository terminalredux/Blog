<?php

namespace Application\Form;

use Zend\Form\Form;

class CategoryForm extends Form {

    public function __construct($name = 'category') 
    {
        parent::__construct($name);
        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'name',
            'type' => 'text',
            'options' => [
                'label' => 'Nazwa kategorii',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Dodaj',
                'id' => 'saveCategoryForm',
            ]
        ]);
        $this->setAttribute('method', 'POST');
    }

}
