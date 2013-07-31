<?php

namespace Application\Controller;

use Application\Entity\CompanyListing;
use Application\Form\listing;
use Zend\Mvc\Controller\AbstractActionController,
Zend\View\Model\ViewModel,
Category\Form\CategoryFormValidator,
Zend\Mvc\Controller\ActionController,
Doctrine\ORM\EntityManager,
Zend\Paginator;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator as ZPaginator;

class IndexController extends AbstractActionController
{
	
	
	
	protected $em;
	
	public function getEntityManager()
	{
		if (null === $this->em) {
			$this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		}
		return $this->em;
	}
	
	
	
	
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function aboutAction()
    {
    	
    	return new ViewModel();
    }
    
    public function categoryAction()
    
    {
    	return new ViewModel(array(
    			'hello' => "hello this is demo"
    	));
    	
    }
    
    public function managelistingAction()
    
    {
    	$this->layout('layout/layout_admin');
		$repository = $this->getEntityManager()->getRepository('Application\Entity\CompanyListing');
		$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
		$em = $this->getEntityManager();
		
		if($authService->hasIdentity())
		{
			$loggedInUser = $authService->getIdentity();
			$this->layout()->loggedInUser = $loggedInUser;
			
			$messages = $this->flashMessenger()->getMessages();
			
			$query = $em->createQuery('select list,list._id,list._listingName,list._subCategoryOne from Application\Entity\CompanyListing list');
			
			
			$paginator = new ZPaginator(
					new DoctrinePaginator(new ORMPaginator($query))
			);
			// 			echo "<pre>";
			// 			print_r($this->params());
			// 			die;
			$paginator->setCurrentPageNumber($this->params('page',1))
			->setItemCountPerPage(10);
			
			return new ViewModel(array(
					'messages' => $messages,
					'paginator' => $paginator
			));
			
		}
		else
		{
			return $this->redirect()->toRoute('login');
		}
    	
    	
    }
    
    
    public function listingAction()
    
    {
    	$em = $this->getEntityManager();
    	
    	$form = new Listing();
    	$request = $this->getRequest();
    	
    	$listing = new CompanyListing();
    	$listing->populate($request->getPost());
    	
    	if($request->isPost())
    	{
//     		$formValidator = new CategoryFormValidator();
//     		$form->setInputFilter($formValidator->getInputFilter());
    		$form->setData($request->getPost());
    		
    		 
    		
    		
//     		if($form->isValid()){
//     			{
    				

    				$em->persist($listing);
    				$em->flush();
    				$this->flashMessenger()->addMessage('Listing added successfully','success');
    				echo "Data Saved";
    				
//    				return $this->redirect()->toRoute('managecategory');
//     			}
//     		}
    				
    				
    	}
    	
    	//die;
    	 
    	return array('form' => $form);
    	
    }
    
    
}
