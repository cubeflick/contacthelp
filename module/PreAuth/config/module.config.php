<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace PreAuth;

return array(
    'router' => array(
        'routes' => array(
        	'login' => array(
        		'type' => 'Zend\Mvc\Router\Http\Literal',
        		'options' => array(
        			'route'    => '/login',
        			'defaults' => array(
        				'controller' => 'PreAuth\Controller\Index',
        				'action'     => 'login',
        			),
        		),
        	),
        		'dashboard' => array(
        				'type' => 'Zend\Mvc\Router\Http\Literal',
        				'options' => array(
        						'route'    => '/admin/dashboard',
        						'defaults' => array(
        								'controller' => 'PreAuth\Controller\Index',
        								'action'     => 'dashboard',
        						),
        				),
        		),
        		'logout' => array(
        				'type' => 'Zend\Mvc\Router\Http\Literal',
        				'options' => array(
        						'route'    => '/logout',
        						'defaults' => array(
        								'controller' => 'PreAuth\Controller\Index',
        								'action'     => 'logout',
        						),
        				),
        		),
        		
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        )
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
            'PreAuth\Controller\Index' => 'PreAuth\Controller\IndexController'
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
            'preauth/index/index' => __DIR__ . '/../view/pre-auth/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
	'view_helpers' => array(
			'invokables' => array(
					'identity' => 'Zend\View\Helper\IdentityHelper',
					// more helpers here ...
			)
	),
    'doctrine' => array(
    		'authentication' => array(
    				'orm_default' => array(
		                'object_manager' => 'Doctrine\ORM\EntityManager',
		                'identity_class' => 'PreAuth\Entity\User',
		                'identity_property' => 'username',
		                'credential_property' => 'password'
    		),
      ),
			
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
