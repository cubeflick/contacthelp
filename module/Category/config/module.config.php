<?php
namespace Category;
 
return array(
    'controllers' => array(
        'invokables' => array(
            'Category\Controller\Index' => 'Category\Controller\IndexController',
        ),
    ),
	// The following section is new and should be added to your file
	'router' => array(
			'routes' => array(
					'category' => array(
							'type'    => 'segment',
							'options' => array(
									'route'    => '/category[/:action][/:id]',
									'constraints' => array(
											'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
											'id'     => '[0-9]+',
									),
									'defaults' => array(
											'controller' => 'Category\Controller\Index',
											'action'     => 'index',
									),
							),
					),
					'managecategory' => array(
							'type' => 'Zend\Mvc\Router\Http\Literal',
							'options' => array(
									'route'    => '/category/manage',
									'defaults' => array(
											'controller' => 'Category\Controller\Index',
											'action'     => 'manage',
									),
							),
					),			
					'add' => array(
							'type' => 'Zend\Mvc\Router\Http\Literal',
							'options' => array(
									'route'    => '/category/add',
									'defaults' => array(
											'controller' => 'Category\Controller\Index',
											'action'     => 'add',
									),
							),
					),
					'editcategory' => array(
							'type' => 'Zend\Mvc\Router\Http\Literal',
							'options' => array(
									'route'    => '/category/edit/[/:id]',
									'defaults' => array(
											'controller' => 'Category\Controller\Index',
											'action'     => 'edit',
									),
							),
					),
					'managesubcategory' => array(
							'type' => 'Zend\Mvc\Router\Http\Literal',
							'options' => array(
									'route'    => '/subcategory/manage',
									'defaults' => array(
											'controller' => 'Category\Controller\Index',
											'action'     => 'subcategorymanage',
									),
							),
					),
					'subacatadd' => array(
							'type' => 'Zend\Mvc\Router\Http\Literal',
							'options' => array(
									'route'    => '/subcategory/add',
									'defaults' => array(
											'controller' => 'Category\Controller\Index',
											'action'     => 'subcategoryadd',
									),
							),
					),
					
					'subcatdelete' => array(
							'type' => 'Zend\Mvc\Router\Http\segment',
							'options' => array(
									'route'    => '/subcategory/delete/[/:id]',
									'defaults' => array(
											'controller' => 'Category\Controller\Index',
											'action'     => 'subcategorydelete',
									),
							),
					),
						
					
					'editsubcategory' => array(
							'type' => 'Zend\Mvc\Router\Http\segment',
							'options' => array(
									'route'    => '/subcategory/edit/[/:id]',
									'defaults' => array(
											'controller' => 'Category\Controller\Index',
											'action'     => 'subcategoryedit',
									),
							),
					),
						
						
			),
	),
		
    'view_manager' => array(
        'template_path_stack' => array(
            'categories' => __DIR__ . '/../view',
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
	)
		
);