<?php

namespace PreAuth\Controller;

use Zend\Mvc\Controller\AbstractActionController,
Zend\Mvc\Controller\Plugin,
Zend\View\Model\ViewModel,
Zend\View\Helper,
PreAuth\Entity\User,
PreAuth\Form\Login;



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
    
    
    public function loginAction()
    {
		 	
    		$form = new Login(); 
		    $request = $this->getRequest(); 
		
		    if($request->isPost()) 
		    { 
		    	$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
		    	$adapter = $authService->getAdapter();
		    	$adapter->setIdentityValue($request->getPost('username'));
		    	$adapter->setCredentialValue($request->getPost('password'));
		    	$authResult = $authService->authenticate();
    	    	/*
    	    	 * get the Identity
    	    	 */
    	    	$identity = $authResult->getIdentity();
    	
    	    	if ($authResult->isValid()) {
    	
    	    		/* write the identity through the storage
    	    		 *
    	    		 */
    	    		$authService->getStorage()->write($identity);
    	    		return $this->redirect()->toRoute('dashboard');
    	    	}
    	
    	    	return new ViewModel(array(
    	    			'error' => 'Your authentication credentials are not valid',
    	    			'form' => $form
    	    	));
		    			  
		    } 
		    
		    return array('form' => $form); 

    }
    /*
     * function to logout
     */
    
    public function logoutAction()
    {
    	$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
    	$authService->clearIdentity();
    	return $this->redirect()->toRoute('login');
    }
    
    public function dashboardAction()
    {
    	
    	//$identity = $this->plugin('identity');
    	
		$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
		$loggedInUser = $authService->getIdentity();
		
		$this->layout()->loggedInUser = $loggedInUser; 
		if($loggedInUser)
		{	
	    	return new ViewModel(array(
	    			'loggedInUser' => $loggedInUser
	    	));
		}
		
    }
    
    
}
