<?php
return array(
    'modules' => array(
    	'ZendDeveloperTools',
    	'AtCms',
    	'AtAdmin',		
    	'BjyProfiler',
        'Application',
    	'PreAuth',
        'Formgen',
    	'Category',
		'DoctrineModule',
    	'DoctrineORMModule'
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            './module',
            './vendor',
        ),
    ),
);