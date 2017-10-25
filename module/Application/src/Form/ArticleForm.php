<?php

namespace Application\Form;

use Zend\Form\Form;

class ArticleForm extends Form {

    public function __construct($name = 'article') 
    {
        parent::__construct($name);
        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'title',
            'type' => 'text',
            'options' => [
                'label' => 'Tytuł',
            ],
        ]);
        $this->add([
            'name' => 'content',
            'type' => 'text',
            'options' => [
                'label' => 'Treść',
            ],
        ]);
        $this->add([
            'name' => 'published',
            'type' => 'checkbox',
            'options' => [
                'label' => 'Publikacja',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Dodaj',
                'id' => 'saveArticleForm',
            ]
        ]);
        $this->setAttribute('method', 'POST');
    }

}
