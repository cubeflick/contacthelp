<?php

namespace Application\Controller;

use Zend\Validator\NotEmpty;

use Zend\Filter\Null;

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
			
			$query = $em->createQuery('select list,list._id,list._listingName,list._subCategoryOne,list._subCategoryTwo,list._subCategoryThree,
					list._companyUrl,list._department,list._phoneNumber,list._stepToReach,list._customerServiceLink,
					list._customerSupportEmail,list._operationHours,list._description,list._additionalNote,list._userName,
					list._userEmail,list._status from Application\Entity\CompanyListing list');
			
// 						print_r($query);
// 						die;
			
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
    	$request = $this->getRequest();
    	$repository = $this->getEntityManager()->getRepository('Category\Entity\Category');
        $em = $this->getEntityManager();
    	
    	$form = new Listing();
    	
    	
    	$listing = new CompanyListing();
    	$listing->populate($request->getPost());
    	
    	$resultset = $repository->findBy(array('parentId'=>null));
    	/*
    	 * Get the array hydrator of entity
    	*/
    	 
    	$arrayOptions = array();
    	foreach ($resultset as $key => $result)
    	{
    		$arrayOptions[$result->getId()] = $result->getName();
    	}
//     	print_r($arrayOptions);
//     	die;
  
//     	$query = $em->createQuery('select cat.id, cat.cname, cat.description, childcat.cname as parent from Category\Entity\Category cat join Category\Entity\Category childcat with cat.parentId = childcat.id');
//     	$subcats = $query->getResult();
    	 
    	$query = $em->createQuery("select cat.id, cat.cname, cat.description FROM Category\Entity\Category cat JOIN cat.parentId");
    	$resutlset = $query->getResult();
echo "<pre>";
print_r($resutlset);
    	die;
    	$resultset1 = $repository->findAll();
    	/*
    	 * Get the array hydrator of entity
    	*/
    	
    	$arrayOptions1 = array();
    	foreach ($resultset1 as $key1 => $result1)
    	{
    		$arrayOptions1[$result1->getId()] = $result1->getName();
    	}
    	
//     	print_r($resultset1[0]);
//     	echo $resultset1[0]->getName();
//        	die;
    
    	
    	
    	
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
    	 
    	return array('form' => $form, 'category' => $arrayOptions, 'subcategory' => $resultset1);
//     	return new ViewModel(array(
    			 
//     			'category' => $arrayOptions
//     	));
    	
    }
    
    
}
