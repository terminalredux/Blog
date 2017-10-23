<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\CategoryTable;

class IndexController extends AbstractActionController
{
    private $categoryTable = null;
    
    public function __construct(CategoryTable $categoryTable) {
        $this->categoryTable = $categoryTable;
    }
    
    public function indexAction()
    {
        $view = new ViewModel();
        $model = $this->categoryTable;
        $row = $model->getById(1);
        
        $view->setVariable('id', $row->getId());
        $view->setVariable('name', $row->getName());
        $view->setVariable('created_at', $row->getCreatedAt());
        $view->setVariable('updated_at', $row->getUpdatedAt());
                
        return $view;
    }
}
