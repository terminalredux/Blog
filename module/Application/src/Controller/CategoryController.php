<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\CategoryTable;
use Application\Model\Category;
use Application\Model\CategoryForm;

class CategoryController extends AbstractActionController
{
    private $categoryTable = null;
    
    public function __construct(CategoryTable $categoryTable) 
    {
        $this->categoryTable = $categoryTable;
    }
    
    public function indexAction()
    {
        $view = new ViewModel();
        $rows = $this->categoryTable->getBy();
        
        $view->setVariable('categories', $rows);
        
        return $view;
    }
    
    public function addAction() 
    {
        $request = $this->getRequest();
        $categoryForm = new CategoryForm();
        $categoryForm->get('submit')->setValue('Dodaj');
        
        if (!$request->isPost()) {
            return ['categoryForm' => $categoryForm];
        }
        
        $categoryModel = new Category();
        $categoryForm->setInputFilter($categoryModel->getInputFilter());
        $categoryForm->setData($request->getPost());
        
        if (!$categoryForm->isValid()) {
            return ['categoryForm' => $categoryForm];
        }
        
        $categoryModel->exchangeArray($categoryForm->getData());
        $this->categoryTable->save($categoryModel);
        return $this->redirect()->toRoute('categories');
    }
}