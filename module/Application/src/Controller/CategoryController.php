<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\CategoryTable;
use Application\Model\Category;
use Application\Form\CategoryForm;

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
    
    public function editAction() 
    {
        $view = new ViewModel();
        $categoryId = (int) $this->params()->fromRoute('id');
        $view->setVariable('categoryId', $categoryId);
        
        if (0 == $categoryId) {
            return $this->redirect()->toRoute('categories', ['action' => 'add']);
        }
        try {
            $categoryRow = $this->categoryTable->getById($categoryId);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('categories', ['action' => 'index']);
        }
        
        $categoryForm = new CategoryForm();
        $categoryForm->bind($categoryRow);
        $categoryForm->get('submit')->setAttribute('value', 'Zapisz');
        
        $request = $this->getRequest();
        $view->setVariable('categoryForm', $categoryForm);
        
        if (!$request->isPost()) {
            return $view;
        }
        
        $categoryForm->setInputFilter($categoryRow->getInputFilter());
        $categoryForm->setData($request->getPost());
        
        if (!$categoryForm->isValid()) {
            return $view;
        }
        
        $this->categoryTable->save($categoryRow);
        return $this->redirect()->toRoute('categories', ['action' => 'index']);
    }
}