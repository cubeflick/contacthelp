<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController,
Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function aboutAction()
    {
    	
    	return new ViewModel();
    }
}
