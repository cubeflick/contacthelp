<?php
namespace Application;
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        	'about' => array(
        		'type' => 'Zend\Mvc\Router\Http\Literal',
        		'options' => array(
        			'route'    => '/about',
        			'defaults' => array(
        				'controller' => 'Application\Controller\Index',
        				'action'     => 'about',
        			),
        		),
        	),
        	'news' => array(
        			'type' => 'Zend\Mvc\Router\Http\Literal',
        			'options' => array(
        					'route'    => '/news',
        					'defaults' => array(
        							'controller' => 'Application\Controller\Index',
        							'action'     => 'news',
        					),
        			),
        	),
        	
        	'contact' => array(
        			'type' => 'Zend\Mvc\Router\Http\Literal',
        			'options' => array(
        					'route'    => '/contact',
        					'defaults' => array(
        							'controller' => 'Application\Controller\Index',
        							'action'     => 'contact',
        					),
        			),
        	),
        	
        	'addlisting' => array(
        		'type' => 'Zend\Mvc\Router\Http\Literal',
        		'options' => array(
        			'route'    => '/listing/add',
        			'defaults' => array(
        				'controller' => 'Application\Controller\Index',
        				'action'     => 'listing',
        			),
        		),
        	),
        	
        	'addrating' => array(
        			'type' => 'Zend\Mvc\Router\Http\Segment',
        			'options' => array(
        					'route'    => '/comments[/:listing]',
        					'defaults' => array(
        							'controller' => 'Application\Controller\Index',
        							'action'     => 'rating',
        					),
        			),
        	),
        	
        	
        	
        	
//         	'frontcategorylisting' => array(
//         			'type' => 'Zend\Mvc\Router\Http\Segment',
//         			'options' => array(
//         					'route'    => '/',
//         					'defaults' => array(
//         							'controller' => 'Application\Controller\Index',
//         							'action'     => 'category',
//         					),
//         			),
//         	),
        	
        	
        	
        	'manage_listing' => array(
        			'type' => 'Zend\Mvc\Router\Http\Literal',
        			'options' => array(
        					'route'    => '/listing/manage',
        					 
        					'defaults' => array(
        							'controller' => 'Application\Controller\Index',
        							'action'     => 'managelisting',
        							 
        					),
        			),
        	),
        	
        	 
        	'approve_listing' => array(
        			'type' => 'Zend\Mvc\Router\Http\Segment',
        			'options' => array(
        					'route'    => '/approve[/:id]',
        					
        					'defaults' => array(
        							'controller' => 'Application\Controller\Index',
        							'action'     => 'manage',
        							
        					),
        			),
        	),
        	
        	
        
        	
        	'listing_record' => array(
        			'type' => 'Zend\Mvc\Router\Http\Segment',
        			'options' => array(
        					'route'    => '/directory[/:catname][/:subcatname][/:listingname]',
        	
        					'defaults' => array(
        							'controller' => 'Application\Controller\Index',
        							'action'     => 'companyrecord',
        	
        					),
        			),
        	),
        	 

        	'companylist' => array(
        			'type' => 'Zend\Mvc\Router\Http\Segment',
        			'options' => array(
        					'route'    => '/directory[/:catname][/:subcatname]',
        					 
        					'defaults' => array(
        							'controller' => 'Application\Controller\Index',
        							'action'     => 'companylist',
        							 
        					),
        			),
        	),


        	'subcategory' => array(
        			'type' => 'Zend\Mvc\Router\Http\Segment',
        			'options' => array(
        					'route'    => '/directory[/:catname]',
        					'defaults' => array(
        							'controller' => 'Application\Controller\Index',
        							'action'     => 'subcategory',
        	
        					),
        			),
        	),
        	 
        	
        	
        	'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
    		'driver' => array(
    				__NAMESPACE__ . '_driver' => array(
    						'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
    						'cache' => 'array',
    						'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
    				),
    				'orm_default' => array(
    						'drivers' => array(
    								__NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
    						)
    				)
    		)
    ),
);

