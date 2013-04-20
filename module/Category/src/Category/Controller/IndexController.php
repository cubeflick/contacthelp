<?php
namespace Category\Controller; 


use Category\Form\CategoryFormValidator,
Zend\Mvc\Controller\ActionController,
Doctrine\ORM\EntityManager,
Zend\Mvc\Controller\AbstractActionController,
Zend\View\Model\ViewModel,
Category\Entity\Category,
Category\Form\CategoryForm,
SynergyDataGrid\Grid\JqGrid ;

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
			$categories = $repository->findAll();
	
			return new ViewModel(array(
					'messages' => $messages,
					'categories' => $categories
			));
	
		}
		else
		{
			return $this->redirect()->toRoute('login');
		}
		 
	}
	
    public function addAction()
    {
    	
    	
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
    		$categories = $repository->findAll();
    
    		return new ViewModel(array(
    				'messages' => $messages,
    				'categories' => $categories
    		));
    
    	}
    	else
    	{
    		return $this->redirect()->toRoute('login');
    	}
    		
    }
    
    public function subcategoryaddAction()
    {
    	 
    	 
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
    
    public function subcategoryeditAction()
    {
    	 
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