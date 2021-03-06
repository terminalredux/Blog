<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'categories' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/categories[/:action][/:id]',
                    'defaults' => [
                        'controller' => Controller\CategoryController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'articles' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/articles[/:action][/:id]',
                    'defaults' => [
                        'controller' => Controller\ArticleController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => function($sm) {
                $categoryService = $sm->get('Application\Model\CategoryTable');

                return new Controller\IndexController($categoryService);
            },
            Controller\CategoryController::class => function($sm) {
                $categoryService = $sm->get('Application\Model\CategoryTable');

                return new Controller\CategoryController($categoryService);
            },
            Controller\ArticleController::class => function($sm) {
                $articleService = $sm->get('Application\Model\ArticleTable');
                
                return new Controller\ArticleController($articleService);
            }
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
		'base_path' => '/Blog/public'
    ],
];
