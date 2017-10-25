<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Application\Model\Category;
use Application\Model\CategoryTable;
use Application\Model\Article;
use Application\Model\ArticleTable;

class Module
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    
    public function getServiceConfig() {
        return [
            'factories' => [
                'CategoryTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    
                    $resultSetPrototype = new ResultSet;
                    $resultSetPrototype->setArrayObjectPrototype(new Category());
                    return new TableGateway('category', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\CategoryTable' => function ($sm) {
                    $tableGateway = $sm->get('CategoryTableGateway');
                    $table = new CategoryTable($tableGateway);
                    
                    return $table;
                },
                'ArticleTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    
                    $resultSetPrototype = new ResultSet;
                    $resultSetPrototype->setArrayObjectPrototype(new Article());
                    return new TableGateway('article', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\ArticleTable' => function ($sm) {
                    $tableGateway = $sm->get('ArticleTableGateway');
                    $table = new ArticleTable($tableGateway);
                    
                    return $table;
                }
            ],
        ];
    }
}
