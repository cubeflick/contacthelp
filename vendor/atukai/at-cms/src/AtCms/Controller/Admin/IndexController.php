<?php

namespace AtCms\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class Admin_IndexController
 * @package AtCms\Controller
 */
class Admin_IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
