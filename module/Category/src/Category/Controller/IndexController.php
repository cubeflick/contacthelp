<?php
namespace Category\Controller; 


use Category\Form\SubCategoryForm;

use Category\Form\CategoryFormValidator,
Zend\Mvc\Controller\ActionController,
Doctrine\ORM\EntityManager,
Zend\Mvc\Controller\AbstractActionController,
Zend\View\Model\ViewModel,
Category\Entity\Category,
Zend\Paginator,
Category\Form\CategoryForm;

/*
 * Paginator
 */
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator as ZPaginator;


class IndexController extends AbstractActionController
{
	
	/**
	 * @var Doctrine\ORM\EntityManager
	 */
	protected $em;
	
	public function getEntityManager()
	{
		if (null === $this->em) {
			$this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		}
		return $this->em;
	}

	public function manageAction()
	{
		$this->layout('layout/layout_admin');
		$repository = $this->getEntityManager()->getRepository('Category\Entity\Category');
		$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
		$em = $this->getEntityManager();
		 
		 
		if($authService->hasIdentity())
		{
			$loggedInUser = $authService->getIdentity();
			$this->layout()->loggedInUser = $loggedInUser;
				
			/*
			 * set the message to display in view
			* Get the results from the database
			*/
			$messages = $this->flashMessenger()->getMessages();
			
			/*
			 * Write the dql
			 * create the query
			 * create doctrine paginator
			 * pass doctrine pagainator adapter in zend paginator
			 */
			$query = $em->createQuery('select cat,cat.id, cat.cname, cat.description from Category\Entity\Category cat where cat.parentId is null');

			// Create the paginator itself
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
	
    public function addAction()
    {
    	
    	$this->layout('layout/layout_admin');
    	$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
    	if($authService->hasIdentity())
    	{
    		$loggedInUser = $authService->getIdentity();
    		$this->layout()->loggedInUser = $loggedInUser;
    	}
    	else
    	{
    		return $this->redirect()->toRoute('login');
    	}
    	 
    	
    	$em = $this->getEntityManager();
    	
    	$form = new CategoryForm();
    	$request = $this->getRequest();	
    	$category = new Category();

    	/*
    	 * populate entity properties from form array
    	 */
    	$category->populate($request->getPost());

    	if($request->isPost())
    	{
     		$formValidator = new CategoryFormValidator();
     		$form->setInputFilter($formValidator->getInputFilter());
     		$form->setData($request->getPost());
    		
     		if($form->isValid()){
     			{
			        $em->persist($category);
			        $em->flush();    
			        $this->flashMessenger()->addMessage('Category added successfully','success');
			        return $this->redirect()->toRoute('managecategory');
    			}
    		}
    	
    	}
    	
    	return array('form' => $form);
    	 
    }

    /*
     * Edit the Category 
     */
    
    public function editAction()
    {
    	$this->layout('layout/layout_admin');
    	$request = $this->getRequest();
    	 
    	$id = (int) $this->params('id', null);
    	if (null === $id) {
    		return $this->redirect()->toRoute('managecategory');
    	}

    	$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
    	$em = $this->getEntityManager();
    	
    	if($authService->hasIdentity())
    	{
    		$loggedInUser = $authService->getIdentity();
    		$this->layout()->loggedInUser = $loggedInUser;
    	}
    	else
    	{
    		return $this->redirect()->toRoute('login');
    	}
    	
    	$entity = $em->find('Category\Entity\Category', $id);
    	
    	$form = new CategoryForm();
    	$form->bind($entity);

    	if($request->isPost())
    	{
     		$formValidator = new CategoryFormValidator();
     		$form->setInputFilter($formValidator->getInputFilter());
     		$form->setData($request->getPost());
    		
     		if($form->isValid()){
     			{
			        $em->persist($entity);
			        $em->flush();    
			        $this->flashMessenger()->addMessage('Category updated successfully','success');
			        return $this->redirect()->toRoute('managecategory');
    			}
    		}
    	
    	}
    	
    	return array('form' => $form);
    	 
    }
    
    public function deleteAction()
    {
    }
    
    public function subcategorymanageAction()
    {
    	$this->layout('layout/layout_admin');
    	$repository = $this->getEntityManager()->getRepository('Category\Entity\Category');
    	$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
    	$em = $this->getEntityManager();
    		
    		
    	if($authService->hasIdentity())
    	{
    		$loggedInUser = $authService->getIdentity();
    		$this->layout()->loggedInUser = $loggedInUser;
    
    		/*
    		 * set the message to display in view
    		* Get the results from the database
    		*/
    		$messages = $this->flashMessenger()->getMessages();
			$query = $em->createQuery('select cat.id, cat.cname, cat.description, childcat.cname as parent from Category\Entity\Category cat join Category\Entity\Category childcat with cat.parentId = childcat.id');
			$subcats = $query->getResult();
    		
    		return new ViewModel(array(
    				'messages' => $messages,
    				'categories' => $subcats
    		));
    
    	}
    	else
    	{
    		return $this->redirect()->toRoute('login');
    	}
    		
    }
    
    public function subcategoryaddAction()
    {
    	$this->layout('layout/layout_admin');
		$request = $this->getRequest();    	 
    	
		$repository = $this->getEntityManager()->getRepository('Category\Entity\Category');
		$em = $this->getEntityManager();
    	
    	/*
    	 * Authetication block Start
    	 */
    	$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
    	if($authService->hasIdentity())
    	{
    		$loggedInUser = $authService->getIdentity();
    		$this->layout()->loggedInUser = $loggedInUser;
    	}
    	else
    	{
    		return $this->redirect()->toRoute('login');
    	}
    	/*
    	 * Authentication block End
    	 */
    	
    	$resultset = $repository->findBy(array('parentId'=>null));
    	/*
    	 * Get the array hydrator of entity	
    	 */
    	
    	$arrayOptions = array();
    	foreach ( $resultset as $key => $result)
    	{
    		$arrayOptions[$result->getId()] = $result->getName(); 
    	}	 
    	
    	$form = new SubCategoryForm();
    	$form->get('parent_id')->setAttribute('options', $arrayOptions);

    	
    	/*
    	 * get the object of entity
    	 */
    	$category = new Category();
    
    	/*
    	 * populate entity properties from form array
    	*/
    	$category->populate($request->getPost());
    
    	if($request->isPost())
    	{
    		$formValidator = new CategoryFormValidator();
    		$form->setInputFilter($formValidator->getInputFilter());
    		$form->setData($request->getPost());
    
    		if($form->isValid()){
    			{
    				$em->persist($category);
    				$em->flush();
    				$this->flashMessenger()->addMessage('Sub Category added successfully','success');
    				return $this->redirect()->toRoute('managesubcategory');
    			}
    		}
    		 
    	}
    	 
    	return array('form' => $form);
    
    }
    
    /*
     * Edit the Category
    */
    
    public function subcategoryeditAction()
    {
    	$this->layout('layout/layout_admin');
    	$request = $this->getRequest();
    
    	$id = (int) $this->params('id', null);
    	if (null === $id) {
    		return $this->redirect()->toRoute('managecategory');
    	}
    
    	$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
    	$em = $this->getEntityManager();
    	 
    	if($authService->hasIdentity())
    	{
    		$loggedInUser = $authService->getIdentity();
    		$this->layout()->loggedInUser = $loggedInUser;
    	}
    	else
    	{
    		return $this->redirect()->toRoute('login');
    	}
    	 
    	$entity = $em->find('Category\Entity\Category', $id);
    	 
    	$form = new CategoryForm();
    	$form->bind($entity);
    
    	if($request->isPost())
    	{
    		$formValidator = new CategoryFormValidator();
    		$form->setInputFilter($formValidator->getInputFilter());
    		$form->setData($request->getPost());
    
    		if($form->isValid()){
    			{
    				$em->persist($entity);
    				$em->flush();
    				$this->flashMessenger()->addMessage('Category updated successfully','success');
    				return $this->redirect()->toRoute('managecategory');
    			}
    		}
    		 
    	}
    	 
    	return array('form' => $form);
    
    }
    
    public function subcategorydeleteAction()
    {
    }
        
}