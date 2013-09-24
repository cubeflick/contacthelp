<?php 
namespace Application\Form; 

use Zend\Captcha; 
use Zend\Form\Element; 
use Zend\Form\Form; 

class Rating extends Form 

{ 
    public function __construct($name = null) 
    { 
        parent::__construct('user'); 
        
        $this->setAttribute('method', 'post'); 
        
        $this->add(array(
        		'name' => 'listing_name',
        		'type' => 'Zend\Form\Element\Text',
        		'attributes' => array(
        				'class' => 'login-inp',
        
        				'required' => 'required',
        		),
        		'options' => array(
        				'label' => 'Listing/Company Name',
        		),
        ));
        
        $this->add(array(
        		'name' => 'comments',
        		'type' => 'Zend\Form\Element\Textarea',
        		'attributes' => array(
        				'class' => 'form-textarea',
        
        		),
        		'options' => array(
        				'label' => 'Comments',
        		),
        ));
        
        
        
        $this->add(array(
        		'name' => 'reachability',
        		'type' => 'Zend\Form\Element\Select',
        		'attributes' => array(
        				'class' => 'inp-form',
        
        		),
        		'options' => array(
        				'label' => 'Reachability',
        		),
        ));
        $this->add(array(
        		'name' => 'return_process',
        		'type' => 'Zend\Form\Element\Select',
        		'attributes' => array(
        				'class' => 'inp-form',
        
        		),
        		'options' => array(
        				'label' => 'Return Process',
        		),
        ));
        $this->add(array(
        		'name' => 'issue_resolution',
        		'type' => 'Zend\Form\Element\Select',
        		'attributes' => array(
        				'class' => 'inp-form',
        
        		),
        		'options' => array(
        				'label' => 'Issue Resolution',
        		),
        ));
        $this->add(array(
        		'name' => 'friendliness',
        		'type' => 'Zend\Form\Element\Select',
        		'attributes' => array(
        				'class' => 'inp-form',
        
        		),
        		'options' => array(
        				'label' => 'Friendliness',
        		),
        ));
        $this->add(array(
        		'name' => 'service_knowledge',
        		'type' => 'Zend\Form\Element\Select',
        		'attributes' => array(
        				'class' => 'inp-form',
        
        		),
        		'options' => array(
        				'label' => 'Service Knowledge',
        		),
        ));
        
        
        $this->add(array(
        		'name' => 'screen_name',
        		'type' => 'Zend\Form\Element\Text',
        		'attributes' => array(
        				'class' => 'inp-form',
        
        		),
        		'options' => array(
        				'label' => 'Screen Name',
        		),
        ));
        
        $this->add(array(
        		'name' => 'user_name',
        		'type' => 'Zend\Form\Element\Text',
        		'attributes' => array(
        				'class' => 'inp-form',
        
        		),
        		'options' => array(
        				'label' => 'Your Name',
        		),
        ));
        
        $this->add(array(
        		'name' => 'user_email',
        		'type' => 'Zend\Form\Element\Text',
        		'attributes' => array(
        				'class' => 'inp-form',
        
        		),
        		'options' => array(
        				'label' => 'Your Email',
        		),
        ));
        
        
        $this->add(array(
        		'type' => 'Zend\Form\Element\Captcha',
        		'name' => 'captcha',
        		'attributes' => array(
        				'required' => 'required',
        		),
        		'options' => array(
        				'label' => 'Please verify you are human',
        				'captcha' => new Captcha\Dumb(),
        		),
        ));
        
        
        $this->add(array(
        		'name' => 'submit',
        		'type' => 'Zend\Form\Element\Submit',
        		'attributes' => array('value' => 'Submit', 'class'=>'submit-listing'),
        		'options' => array(),
        ));
        
        
        
      }
 }