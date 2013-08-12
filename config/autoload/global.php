<?php 
return array(
    'db' => array(
        'driver'         => 'Pdo',
        'dsn'            => 'mysql:dbname=cubeflic_contacthp;host=localhost',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter'
                    => 'Zend\Db\Adapter\AdapterServiceFactory',
        	'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        	'secondary' => 'Application\Navigation\Service\SecondaryNavigationFactory'	
        ),
    		
    ),
	'navigation' => array(
			'default' => array(
					array(
							'label' => 'Home',
							'route' => 'home',
					),
					array(
							'label' => 'About Us',
							'route' => 'about',
					),
					array(
							'label' => 'News',
							'route' => 'home'
					),
					array(
							'label' => 'Add',
							'route' => 'addlisting'
					),
					array(
							'label' => 'Contact Us',
							'route' => 'home'
					)
			),
			'secondary' => array(
					array(
							'label' => 'Home',
							'route' => 'home',
					)
			)
	)

);
