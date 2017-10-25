<?php
namespace Application\Controller;

use Application\Form\ArticleForm;
use Application\Model\Article;
use Application\Model\ArticleTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ArticleController extends AbstractActionController
{
    private $articleTable = null;
    
    public function __construct(ArticleTable $articleTable) 
    {   
        $this->articleTable = $articleTable;
    }
    
    public function indexAction()
    {
        $view = new ViewModel();
        $rows = $this->articleTable->getBy();
        
        $view->setVariable('articles', $rows);
        
        return $view;
    }
    
    public function addAction() 
    {
        $request = $this->getRequest();
        $articleForm = new ArticleForm();
        $articleForm->get('submit')->setValue('Dodaj');
        
        if (!$request->isPost()) {
            return ['articleForm' => $articleForm];
        }
        
        $articleModel = new Article();
        $articleForm->setInputFilter($articleModel->getInputFilter());
        $articleForm->setData($request->getPost());
        
        if (!$articleForm->isValid()) {
            return ['articleForm' => $articleForm];
        }
        
        $articleModel->exchangeArray($articleForm->getData());
        $this->articleTable->save($articleModel);
        return $this->redirect()->toRoute('articles');
    }
    
}

















































































