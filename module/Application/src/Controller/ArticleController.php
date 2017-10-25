<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\ArticleTable;
use Application\Model\Article;


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
    
}

















































































