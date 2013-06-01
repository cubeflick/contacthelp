<?php

return array(
    'router' => array(
        'routes' => array(
            'cms' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/pages/:id',
                    'defaults' => array(
                        'controller' => 'AtCms\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'zfcadmin' => array(
                'child_routes' => array(
                    'cms' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/cms',
                            'defaults' => array(
                                'controller' => 'AtCms\Controller\Admin\Index',
                                'action'     => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'pages' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/pages[/:action][/:id]',
                                    'defaults' => array(
                                        'controller' => 'AtCms\Controller\Admin\Page',
                                        'action'     => 'index',
                                        'page'       => 1,
                                        'show_items' => 20,
                                    ),
                                )
                            )
                        ),
                    ),
                ),
            ),
        ),
    ),

    'navigation' => array(
        'admin' => array(
            'cms' => array(
                'label' => 'CMS',
                'route' => 'zfcadmin/cms',
                'order' => 20,
                'pages' => array(
                    'pages-list' => array(
                        'label' => 'Manage Pages',
                        'route' => 'zfcadmin/cms/pages',
                        'params' => array('action' => 'list'),
                    )
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);