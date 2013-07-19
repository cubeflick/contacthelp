<?php 
namespace Application\Form; 

use Zend\Captcha; 
use Zend\Form\Element; 
use Zend\Form\Form; 

class Listing extends Form 

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
        		'name' => 'department',
        		'type' => 'Zend\Form\Element\Text',
        		'attributes' => array(
        				'class' => 'login-inp',
        				
        				'required' => 'required',
        		),
        		'options' => array(
        				'label' => 'Department',
        		),
        ));
        
        $this->add(array(
        		'name' => 'phone',
        		'type' => 'Zend\Form\Element\Text',
        		'attributes' => array(
        				'class' => 'login-inp',
        				
        				'required' => 'required',
        		),
        		'options' => array(
        				'label' => 'Phone Number',
        		),
        ));
        
        $this->add(array(
        		'name' => 'steps',
        		'type' => 'Zend\Form\Element\Textarea',
        		'attributes' => array(
        				'class' => 'form-textarea',
        				
        		),
        		'options' => array(
        				'label' => 'Steps to reach a person',
        		),
        ));
        
        $this->add(array(
        		'name' => 'website',
        		'type' => 'Zend\Form\Element\Text',
        		'attributes' => array(
        				'class' => 'inp-form',
        				
        		),
        		'options' => array(
        				'label' => 'WebSite Address',
        		),
        ));

        $this->add(array(
        		'name' => 'customer_service_link',
        		'type' => 'Zend\Form\Element\Text',
        		'attributes' => array(
        				'class' => 'inp-form',
        				
        		),
        		'options' => array(
        				'label' => 'Customer Service Link',
        		),
        ));
        
        $this->add(array(
        		'name' => 'support_email',
        		'type' => 'Zend\Form\Element\Text',
        		'attributes' => array(
        				'class' => 'inp-form',
        				
        		),
        		'options' => array(
        				'label' => 'Support Email Address',
        		),
        ));
        
        $this->add(array(
        		'name' => 'category1',
        		'type' => 'Zend\Form\Element\Text',
        		'attributes' => array(
        				'class' => 'inp-form',
        				
        		),
        		'options' => array(
        				'label' => 'Category1',
        		),
        ));
        
        $this->add(array(
        		'name' => 'category2',
        		'type' => 'Zend\Form\Element\Text',
        		'attributes' => array(
        				'class' => 'inp-form',
        				
        		),
        		'options' => array(
        				'label' => 'Category2',
        		),
        ));
        
        $this->add(array(
        		'name' => 'category3',
        		'type' => 'Zend\Form\Element\Text',
        		'attributes' => array(
        				'class' => 'inp-form',
        				
        		),
        		'options' => array(
        				'label' => 'Category3',
        		),
        ));
        
        $this->add(array(
        		'name' => 'operation_hours',
        		'type' => 'Zend\Form\Element\Text',
        		'attributes' => array(
        				'class' => 'inp-form',
        				
        		),
        		'options' => array(
        				'label' => 'Hours of operation',
        		),
        ));
        
        $this->add(array(
        		'name' => 'description',
        		'type' => 'Zend\Form\Element\Textarea',
        		'attributes' => array(
        				'class' => 'form-textarea',
        				
        		),
        		'options' => array(
        				'label' => 'Description',
        		),
        ));
        
        $this->add(array(
        		'name' => 'additional_notes',
        		'type' => 'Zend\Form\Element\Textarea',
        		'attributes' => array(
        				'class' => 'form-textarea',
        				
        		),
        		'options' => array(
        				'label' => 'Additional Note',
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
        
        $this->add(array( 
            'name' => 'csrf', 
            'type' => 'Zend\Form\Element\Csrf', 
        ));        
    } 
} 