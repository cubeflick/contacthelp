<?php 
namespace PreAuth\Form; 

use Zend\Captcha; 
use Zend\Form\Element; 
use Zend\Form\Form; 

class Login extends Form 

{ 
    public function __construct($name = null) 
    { 
        parent::__construct('user'); 
        
        $this->setAttribute('method', 'post'); 
        
        $this->add(array( 
            'name' => 'username', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
            	'class' => 'login-inp',
                'placeholder' => 'Username', 
                'required' => 'required', 
            ), 
            'options' => array( 
                'label' => 'Username', 
            ), 
        )); 

        $this->add(array(
        		'name' => 'password',
        		'type' => 'Zend\Form\Element\Password',
        		'attributes' => array(
        				'class' => 'login-inp',
        				'placeholder' => 'Password',
        				'required' => 'required',
        		),
        		'options' => array(
        				'label' => 'Password',
        		),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array('value' => 'Login', 'class'=>'submit-login'),
            'options' => array(),
        ));
        
        $this->add(array( 
            'name' => 'csrf', 
            'type' => 'Zend\Form\Element\Csrf', 
        ));        
    } 
} 