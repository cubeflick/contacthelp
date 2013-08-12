<?php

namespace Application;

use Zend\Mvc\ModuleRouteListener;


class Module
{
    public function onBootstrap($e)
    {
    	
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        $pages = array('navigation'=>
        		array(
        				'label'  => 'Save',
        				'action' => 'save',
        		),
        		array(
        				'label' =>  'Delete',
        				'action' => 'delete',
        		)
        );
        
//         // create container
//         $container = new \Zend\Navigation\Navigation();
        
//         $container->addPages($pages);
        
//         echo "<pre>";
//         print_r($container);
//         $navigation = $e->getApplication()->getServiceManager()->get('navigation');
//         $navigation->addPages($pages);
//         echo "<pre>";
//         print_r($navigation);
        
        
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    

}
