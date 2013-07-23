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
    		echo "<pre>";
    		print_r($request->getPost()); 
    		
    		
//     		if($form->isValid()){
//     			{
    				
     		echo "Inside valid";

    				$em->persist($listing);
    				$em->flush();
    				$this->flashMessenger()->addMessage('Listing added successfully','success');
//    				return $this->redirect()->toRoute('managecategory');
//     			}
//     		}
    				die;
    				
    	}
    	
    	//die;
    	 
    	return array('form' => $form);
    	
    }
    
    
}
