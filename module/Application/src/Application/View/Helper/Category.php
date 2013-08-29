<?php 

namespace Application\View\Helper;
 
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceManager; 
/**
 * Returns colored string with status name (human-way)
 *
 */
class Category extends AbstractHelper
{
    
	/**
	 * Service Locator
	 * @var ServiceManager
	 */
	protected $serviceLocator;
    /**
     * __invoke
     *
     * @access public
     * @return String
     */
    public function __invoke()
    {
    	$em = $this->serviceLocator->get('doctrine.entitymanager.orm_default');
    	$repository = $em->getRepository('Category\Entity\Category');
    	$resultset = $repository->findBy(array('parentId'=>null));

    	$strCategories = "<ul>";
    	
    	foreach($resultset as $key => $value){
    		
    		$cname = $value->getName();
    		$url = "/directory/".strtolower($cname);
    		$strCategories .= "<li><a href='$url'>$cname</a></li>";
    	}
    	
    	$strCategories .= "</ul>";
    	return $strCategories;
    }
    
    /**
     * Setter for $serviceLocator
     * @param ServiceManager $serviceLocator
     */
    public function setServiceLocator(ServiceManager $serviceLocator)
    {
    	$this->serviceLocator = $serviceLocator;
    }    
    
}    