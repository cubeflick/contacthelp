<?php

namespace AtCms;

use AtCms\Grid\PageGridManager;
use AtCms\Mapper\Block as BlockMapper;
use AtCms\Mapper\PageHydrator;
use AtCms\Mapper\BlockHydrator;
use AtCms\View\Helper\Block as BlockViewHelper;
use AtCms\Block\Type;
use AtDataGrid\DataGrid\DataSource\ZendDbTableGateway;
use AtDataGrid\DataGrid\Renderer\Html;
use Zend\ModuleManager\ModuleManagerInterface;

class Module
{
    /**
     * @param \Zend\ModuleManager\ModuleManagerInterface $moduleManager
     */
    public function init(ModuleManagerInterface $moduleManager)
    {
        $moduleManager->loadModule('AtAdmin');
    }

    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @return array
     */
    public function getServiceConfig()
    {
        return array(
            'aliases' => array(
                'atcms_zend_db_adapter' => 'Zend\Db\Adapter\Adapter',
            ),

            'factories' => array(
                'atcms_module_options' => function ($sm) {
                    $config = $sm->get('Config');
                    return new Options\ModuleOptions(isset($config['atcms']) ? $config['atcms'] : array());
                },

                'atcms_page_hydrator' => function () {
                    $hydrator = new PageHydrator();
                    return $hydrator;
                },

                'atcms_page_mapper' => function ($sm) {
                    $mapper = new Mapper\Page();
                    $mapper->setDbAdapter($sm->get('atcms_zend_db_adapter'));
                    $options = $sm->get('atcms_module_options');
                    $entityClass = $options->getPageEntityClass();
                    $mapper->setEntityPrototype(new $entityClass);
                    $mapper->setHydrator($sm->get('atcms_page_hydrator'));
                    return $mapper;
                },

                'atcms_page_grid_datasource' => function ($sm) {
                    $dataSource = new ZendDbTableGateway(array(
                        'table'     => 'cms_page',
                        'dbAdapter' => $sm->get('atcms_zend_db_adapter'),
                    ));
                    return $dataSource;
                },

                'atcms_page_grid_renderer' => function ($sm) {
                    $renderer = new Html();
                    $renderer->setEngine($sm->get('ViewRenderer'))
                        ->setCssFile('/css/modules/page.css');
                    return $renderer;
                },

                'atcms_page_grid' => function ($sm) {
                    $grid = new Grid\Page($sm->get('atcms_page_grid_datasource'));
                    return $grid;
                },

                'atcms_page_grid_manager' => function ($sm) {
                    $manager = new PageGridManager($sm->get('atcms_page_grid'));
                    $manager->setRenderer($sm->get('atcms_page_grid_renderer'));
                    return $manager;
                },
            ),
        );
    }

    /**
     * @return array
     */
    public function getControllerConfig()
    {
        return array(
            'invokables' => array(
                'AtCms\Controller\Index' => 'AtCms\Controller\IndexController',
                'AtCms\Controller\Admin\Index' => 'AtCms\Controller\Admin_IndexController',
                'AtCms\Controller\Admin\Page' => 'AtCms\Controller\Admin_PageController',
            ),
        );
    }
}