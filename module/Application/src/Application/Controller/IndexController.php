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
use Doctrine\ORM\Query\ResultSetMapping;

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
    	
//     	$this->categoryAction();
        return new ViewModel();
        
    }
    
    public function aboutAction()
    {
    	
    	return new ViewModel();
    }
    
    public function categoryAction()
    
    {
    	
//     	//echo "<pre>";
//     	//print_r($this->params());
//     	$catname = $this->params('catname', null);
//     	echo $catname;
//     	echo "Inside cat";
//     	die;
    	
    	$request = $this->getRequest();
    	$repository = $this->getEntityManager()->getRepository('Category\Entity\Category');
        $em = $this->getEntityManager();
    	
    	$form = new Listing();
    	
    	
    	$listing = new CompanyListing();
    	$listing->populate($request->getPost());
		
    	$resultset = $repository->findBy(array('parentId'=>null));
//     	 echo '<pre>';
//     	 print_r($resultset);
//     	 die;
    	
    	return new ViewModel(array(
    			'hello' => "hello this is demo",
    			'category' => $resultset
    	));
    	
    }
    
    public function subcategoryAction()
    
    {
    	$this->categoryAction();
    	    	$catname = $this->params('catname', null);
//     	    	echo $catname;
//     	    	die;
    	
    	$request = $this->getRequest();
    	$repository = $this->getEntityManager()->getRepository('Category\Entity\Category');
    	$em = $this->getEntityManager();
    	 
    	$form = new Listing();
    	$query = $em->createQuery("select cat.id from Category\Entity\Category cat where cat.cname = '$catname' ");
			$subcats = $query->getResult();
// 			echo '<pre>';
//     		echo $subcats[0]['id'];
//     		die;

			$subcat = $subcats[0];
			$id = $subcat['id'];
// 			echo $id;
// 			die;
			
    	$listing = new CompanyListing();
    	$listing->populate($request->getPost());
    
    	$resultset = $repository->findBy(array('parentId'=> $id));
    	//     	 echo '<pre>';
    	//     	 print_r($resultset);
    	//     	 die;
    	 
    	return new ViewModel(array(
    			'category' => $catname,
    			'subcategory' => $resultset
    	));
    	 
    }
    
    public function companylistAction()
    
    {
    	$catname = $this->params('catname', null);
    	$subcatname = $this->params('subcatname', null);
//     	echo $catname;
//     	echo $subcatname;
//     	die;
    	
    	
    	$request = $this->getRequest();
    	$repository = $this->getEntityManager()->getRepository('Application\Entity\CompanyListing');
    	$em = $this->getEntityManager();
    
    	$form = new Listing();
    
    	
    	$listing = new CompanyListing();
    	$listing->populate($request->getPost());
    
    	$resultset = $repository->findBy(array('_subCategoryTwo'=>$subcatname));
    	//     	 echo '<pre>';
    	//     	 print_r($resultset);
    	//     	 die;
    
    return new ViewModel(array(
    			'category' => $catname,
    			'subcategory' => $subcatname,
    			'company' => $resultset
    	));
    
    }
    
    public function companyrecordAction()
    
    {
    	$catname = $this->params('catname', null);
    	$subcatname = $this->params('subcatname', null);
    	$listingname = $this->params('listingname', null);
//     	    	echo $catname;
//     	    	echo $subcatname;
//     	    	echo $listingname;
//     	    	die;
    	$request = $this->getRequest();
    	$repository = $this->getEntityManager()->getRepository('Application\Entity\CompanyListing');
    	$em = $this->getEntityManager();
    	
    	$form = new Listing();
    	
    	
    	$listing = new CompanyListing();
    	$listing->populate($request->getPost());
    	
    	$resultset = $repository->findBy(array('_listingName'=>$listingname));
//     	    	 echo '<pre>';
//     	    	 print_r($resultset);
//  				 die;
    	
    	return new ViewModel(array(
    			
    			'result' => $resultset
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
    
    
    public function manageAction()
    
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
				
			$resultset = $repository->findBy(array('_id'=> 6));
			$record = $resultset[0];
// 									echo "<pre>";
// 									print_r($resultset);
// 									echo $record->getListingId();
// 									die;

			return array('record' => $record);
					
			
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

    	
       $arrayFinal = array();
    	foreach ($resultset as $key => $category)
    	{
    		$subCatArray = $repository->findBy(array('parentId'=>$category->getId()));
    		$arrayFinal[$category->getName()] = $subCatArray;
    	}
    	
//     	echo'<pre>';
//     	print_r($arrayFinal);
//     foreach ($arrayFinal as $key => $cat)
//     {
//     	echo $key;
//     	foreach($cat as $key1 => $subcat)
//     	{
//     		echo $subcat->getName();
//     	}
//     }
//    	die;
    
    
    	
   
    	
    	
    	
    	
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
    	 
    	return array('form' => $form, 'category' => $arrayFinal);
//     	return new ViewModel(array(
    			 
//     			'category' => $arrayOptions
//     	));
    	
    }
    
    
}
