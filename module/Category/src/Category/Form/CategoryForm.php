<?php 
namespace Category\Form; 

use Zend\Captcha; 
use Zend\Form\Element; 
use Zend\Form\Form; 

class CategoryForm extends Form 

{ 
    public function __construct($name = null) 
    { 
        parent::__construct('category'); 
        
        $this->setAttribute('method', 'post'); 
        
        $this->add(array( 
            'name' => 'cname', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
            	'class' => 'inp-form',	
                'placeholder' => 'Name', 
                'required' => 'required', 
            ), 
            'options' => array( 
                'label' => 'Name', 
            ), 
        )); 

        $this->add(array(
        		'name' => 'description',
        		'type' => 'Zend\Form\Element\Textarea',
        		'attributes' => array(
        				'class' => 'form-textarea',
        				'required' => 'required',
        		),
        		'options' => array(
        				'label' => 'Paragraph',
        		),
        )); 
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array('value' => 'Add', 'class'=>'submit-login'),
            'options' => array(),
        ));
         
    } 
} 