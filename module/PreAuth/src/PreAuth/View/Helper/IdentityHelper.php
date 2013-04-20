<?php
namespace PreAuth\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;


class IdentityHelper extends AbstractHelper
{
	
	
	public function __invoke()
	{
		$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
		$loggedUser = $authService->getIdentity();
		return $loggedUser;
	}
}